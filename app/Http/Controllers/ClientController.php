<?php

namespace App\Http\Controllers;

use App\Banque;
use App\Compte;
use App\Details_personne;
use App\Devis;
use App\Fiche;
use App\Formule;
use App\Hconnexion;
use App\Helpers\Helper;
use App\Historique;
use App\Ip_adresse;
use App\Message;
use App\Personne;
use App\Personne_personne;
use App\Simulation;
use App\User;
use App\User_message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ClientController extends GlobaleController {

   private $civilites;
   private $regimes;
   private $situation_familiales;
   private $provenances;

   public function __construct() {
      $excluded_functions = [
         'getContactDetails', 'modificationPasswordForm', 'modificationPassword',
         'connexionForm', 'connexion', 'inscriptionForm', 'inscription',
         'inscriptionValidation', 'logout', 'devisVerification', 'modificationProfile',
         'refreshCaptcha'];
      $this->middleware('auth.client', ['except' => $excluded_functions]);;
      $this->civilites = $this->listeCivilites();
      $this->regimes = $this->listeRegimes();
      /*$this->situation_familiales = $this->listeSituationFamiliales();
      $this->provenances = $this->listeProvenances();*/
   }

   protected function checkIpAdresse(Request $request) {
      $adresse_ip = $_SERVER['REMOTE_ADDR'];
      $authorizedIpAdresse = Ip_adresse::where('adresse_ip', '=', $adresse_ip)->first();
      Hconnexion::create(['email' => $request->email, 'adresse_ip' => $adresse_ip]);
      if($authorizedIpAdresse != null) {
         abort(403);
      }
   }

   //forme de connexion
   public function connexionForm() {

      $titre = "ACS assurance - Connexion";
      return view('auth-client.connexion', compact('titre'));
   }

   //connexion
   public function connexion(Request $request) {
      $this->checkIpAdresse($request);
      $this->validate($request, [
         'email' => 'required|string',
         'password' => 'required|string',
      ]);
      $personne = Personne::where('email', '=', $request->email)
         ->where('password', '=', $request->password)
         ->first();
      if($personne != null) {
         $personne->type = 'client';
         Session::put('user', $personne);
         //return \redirect('/espace-client/accueil');
         return \redirect('espace-client/mes-devis');
      } else {
         return Redirect::back()->withInput()->withErrors(array('email' => 'Ces identifiants ne correspondent pas à nos enregistrements'));
      }
   }

   //deconnexion
   public function logout() {
      Session::flush();
      return \redirect()->route('login.client');
   }

   //forme inscription
   public function inscriptionForm() {
      $civilites = $this->civilites;
      $regimes = $this->regimes;
      $titre = "ACS assurance - Inscription";
      return view('auth-client.inscription', compact('civilites', 'regimes', 'titre'));
   }

   //validation de steper inscription (step by step)
   public function inscriptionValidation(Request $request, $step_id) {
      $rules = array();
      //change date values
      $request->merge(['date_naissance_conjoint' => Helper::setDateFormat($request->date_naissance_conjoint)]);
      $request->merge(['date_naissance_prospect' => Helper::setDateFormat($request->date_naissance_prospect)]);

      if($request->nombre_enfants != "0") {
         for($i = 1; $i <= $request->nombre_enfants; $i++) {
            $request->merge(['date_naissance_enfant_' . $i => Helper::setDateFormat($request->{'date_naissance_enfant_' . $i})]);
         }
      }

      //step 1 validation rules
      $step_1_rules['nombre_adultes'] = 'required|numeric';
      $step_1_rules['nombre_enfants'] = 'required|numeric';

      $step_1_rules['civilite_prospect'] = 'required';
      $step_1_rules['regime_prospect'] = 'required';
      $step_1_rules['date_naissance_prospect'] = 'required|date';

      $step_1_rules['civilite_conjoint'] = 'required_if:nombre_adultes,==,2';
      $step_1_rules['regime_conjoint'] = 'required_if:nombre_adultes,==,2';
      $step_1_rules['date_naissance_conjoint'] = 'nullable|required_if:nombre_adultes,==,2|date';


      if($request->has('devis_id')) {
         $step_1_rules['numero_securite_sociale'] = 'required';
         $step_1_rules['numero_securite_sociale_conjoint'] = 'required_if:nombre_adultes,==,2';

         $step_3_rules['date_prelevement'] = 'required';
         //compte de paiement
         $step_3_rules['nom_titulaire_compte'] = 'required';
         $step_3_rules['prenom_titulaire_compte'] = 'required';
         $step_3_rules['ville_titulaire_compte'] = 'required';
         $step_3_rules['adresse_titulaire_compte'] = 'required';
         //banque infos
         $step_3_rules['banque_nom'] = 'required';
         $step_3_rules['bic'] = 'required';
         $step_3_rules['iban'] = 'required';
         $step_3_rules['banque_ville'] = 'required';
         $step_3_rules['banque_code_postal'] = 'required';
         $step_3_rules['banque_adresse'] = 'required';

         $step_2_rules['adresse'] = 'required';
      }


      if($request->nombres_enfants != "0") {
         for($i = 1; $i <= $request->nombre_enfants; $i++) {
            $step_1_rules['date_naissance_enfant_' . $i] = 'required|date';
            $step_1_rules['regime_enfant_' . $i] = 'required';
         }
      }
      //step 2 validation rules
      $step_2_rules['nom'] = 'required';
      $step_2_rules['prenom'] = 'required';
      $step_2_rules['code_postal'] = 'required';
      $step_2_rules['ville'] = 'required';
      if((Session::has('user') && Session::get('user')->type == "client") || $request->has('devis_id')) {
         //$step_2_rules['email'] = 'required|unique:personnes,email,' . Session::get('client')->id;
         $step_2_rules['email'] = 'required|email|unique:personnes,email,' . $request->personne_id;
      } else {
         $step_2_rules['email'] = 'required|email|unique:personnes';
      }

      $step_2_rules['telephone'] = 'required';
      $step_3_rules['date_effet'] = 'required';

      switch($step_id) {
         case "1":
            $rules = array_merge($rules, $step_1_rules);
            break;
         case "2":
            $rules = array_merge($rules, $step_2_rules);
            break;
         case "3":
            $rules = array_merge($rules, $step_3_rules);
            break;
         case "4":
            $rules = array_merge($rules, $step_1_rules, $step_2_rules, $step_3_rules);
            break;
      }
      //validation des inputs enfants
      $validator = Validator::make($request->all(), $rules);
      if($validator->fails()) {
         return response()->json(['errors' => $validator->errors()]);
      }

   }

   //inscription
   public function inscription(Request $request) {
      //change date values
      $request->merge(['date_naissance_conjoint' => Helper::setDateFormat($request->date_naissance_conjoint)]);
      $request->merge(['date_naissance_prospect' => Helper::setDateFormat($request->date_naissance_prospect)]);
      $request->merge(['date_effet' => Helper::setDateFormat($request->date_effet)]);

      if($request->nombre_enfants != "0") {
         for($i = 1; $i <= $request->nombre_enfants; $i++) {
            $request->merge(['date_naissance_enfant_' . $i => Helper::setDateFormat($request->{'date_naissance_enfant_' . $i})]);
         }
      }

      //step 1 validation rules
      $rules['nombre_adultes'] = 'required|numeric';
      $rules['nombre_enfants'] = 'required|numeric';

      $rules['civilite_prospect'] = 'required';
      $rules['regime_prospect'] = 'required';
      $rules['date_naissance_prospect'] = 'required|date';

      $rules['civilite_conjoint'] = 'required_if:nombre_adultes,==,2';
      $rules['regime_conjoint'] = 'required_if:nombre_adultes,==,2';
      $rules['date_naissance_conjoint'] = 'nullable|required_if:nombre_adultes,==,2|date';

      if($request->nombres_enfants != "0") {
         for($i = 1; $i <= $request->nombre_enfants; $i++) {
            $rules['date_naissance_enfant_' . $i] = 'required|date';
            $rules['regime_enfant_' . $i] = 'required';
         }
      }
      //step 2 validation rules
      $rules['nom'] = 'required';
      $rules['prenom'] = 'required';
      $rules['co de_postal'] = 'required';
      $rules['ville'] = 'required';
      $rules['email'] = 'required|email|unique:personnes';
      $rules['telephone'] = 'required';
      $rules['date_effet'] = 'required';
      $validator = Validator::make($request->all(), $rules);
      if($validator->fails()) {
         return response()->json(['errors' => $validator->errors()]);
      } else {
         try {
            DB::beginTransaction();
            //création du prospect
            $personneId = Personne::create([
               'nom' => $request->nom,
               'prenom' => $request->prenom,
               'civilite_id' => $request->civilite_prospect,
               'date_naissance' => $request->date_naissance_prospect,
               'regime_id' => $request->regime_prospect,
               'email' => $request->email,
            ])->id;

            //création details personne
            $personneDetailsId = Details_personne::create([
               'personne_id' => $personneId,
               'telephone_1' => $request->telephone,
               'code_postal' => $request->code_postal,
               'ville_id' => $request->ville,
               'adresse' => $request->adresse,
               'email' => $request->email,
            ])->id;

            //création du conjoint
            if($request->nombre_adultes == "2" && !empty($personneId)) {
               $conjointId = Personne::create([
                  'civilite_id' => $request->civilite_conjoint,
                  'date_naissance' => $request->date_naissance_conjoint,
                  'regime_id' => $request->regime_conjoint,
               ])->id;
               Personne_personne::create(['personne_id' => $personneId, 'personne_concerne_id' => $conjointId, 'type_relation' => 'conjoint']);
            }

            //création des enfants
            if($request->nombre_enfants != "0") {
               for($i = 1; $i <= $request->nombre_enfants; $i++) {
                  $enfantId = Personne::create([
                     'date_naissance' => $request->{'date_naissance_enfant_' . $i},
                     'regime_id' => $request->{'regime_enfant_' . $i}
                  ])->id;
                  Personne_personne::create(['personne_id' => $personneId, 'personne_concerne_id' => $enfantId, 'type_relation' => 'enfant']);
               }
            }

            //fiche création
            $ficheId = Fiche::create(['user_id' => 0, 'provenance_id' => 14, 'date_rappel' => null, 'personne_id' => $personneId, 'date_effet' => $request->date_effet, 'etat_id' => 1, 'equipes_autorisees' => ''])->id;

            //$simulationId = Simulation::create(['personne_id' => $personneId, 'type_assurance_id' => 1, 'fiche_id' => $ficheId, 'date_effet' => $request->date_effet])->id;

            Historique::create(['personne_id' => $personneId, 'fiche_id' => $ficheId, 'action_id' => 11, 'vue' => FALSE]);
            Session::flash('message', 'Votre demande a été bien traitée');
            Session::flash('alert-class', 'alert-success');
            DB::commit();

            $user = Personne::find($personneId);
            $user->type = 'client';
            Session::put('user', $user);
            Session::flash('message', 'Votre demande a été bien traitée');
            Session::flash('alert-class', 'alert-success');
            return $this->sendResponse($ficheId, 'Votre demande a été bien traitée');
         } catch(\Exception $e) {
            DB::rollback();
            return $this->sendResponse('', $e->getMessage());
         }
      }
   }

   //page d'accueil espace client
   public function espaceClient() {
      $client = Session::get('client');
      $titre = "ACS Acs assurance - Espace client";
      return view('espace-client.accueil', compact('client', 'titre'));
   }

   //affichage de profile
   public function monProfileDetails() {
      $titre = "ACS Acs assurance - Client profile";
      $civilites = $this->civilites;
      $regimes = $this->regimes;
      $fiche = Fiche:: where('personne_id', Session::get('user')->id)->firstorfail();
      //$fiche = Fiche:: where('personne_id', 30593)->firstorfail();
      $client = Session::get('user');
      return view('espace-client.mon-profile', compact('titre', 'fiche', 'client', 'regimes', 'civilites'));
   }

   //modification de profile (informations de base)
   public function modificationProfile(Request $request) {
      $data_signature = [];
      //check current user id
      $fiche = Fiche::findOrFail($request->fiche_id);

      $personne = \App\Personne::find($fiche->personne->id);
      Session::put('client', $personne);

      if($request->personne_id != Session::get('client')->id) {
         abort('403');
      }

      //change date values
      $request->merge(['date_naissance_conjoint' => Helper::setDateFormat($request->date_naissance_conjoint)]);
      $request->merge(['date_naissance_prospect' => Helper::setDateFormat($request->date_naissance_prospect)]);
      $request->merge(['date_effet' => Helper::setDateFormat($request->date_effet)]);

      if($request->nombre_enfants != "0") {
         for($i = 1; $i <= $request->nombre_enfants; $i++) {
            $request->merge(['date_naissance_enfant_' . $i => Helper::setDateFormat($request->{'date_naissance_enfant_' . $i})]);
         }
      }
      //step 1 validation rules
      $rules['nombre_adultes'] = 'required|numeric';
      $rules['nombre_enfants'] = 'required|numeric';

      $rules['civilite_prospect'] = 'required';
      $rules['regime_prospect'] = 'required';
      $rules['date_naissance_prospect'] = 'required|date';

      $rules['civilite_conjoint'] = 'required_if:nombre_adultes,==,2';
      $rules['regime_conjoint'] = 'required_if:nombre_adultes,==,2';
      $rules['date_naissance_conjoint'] = 'nullable|required_if:nombre_adultes,==,2|date';

      if($request->has('devis_id')) {
         $rules['numero_securite_sociale'] = 'required';
         $rules['numero_securite_sociale_conjoint'] = 'required_if:nombre_adultes,==,2';
         //step 3 validation
         $rules['date_prelevement'] = 'required';
         //compte de paiement
         $rules['nom_titulaire_compte'] = 'required';
         $rules['prenom_titulaire_compte'] = 'required';
         $rules['ville_titulaire_compte'] = 'required';
         $rules['adresse_titulaire_compte'] = 'required';
         //banque infos
         $rules['banque_nom'] = 'required';
         $rules['bic'] = 'required';
         $rules['iban'] = 'required';
         $rules['banque_ville'] = 'required';
         $rules['banque_code_postal'] = 'required';
         $rules['banque_adresse'] = 'required';

         //step 2 validation
         $rules['adresse'] = 'required';
      }

      if($request->nombres_enfants != "0") {
         for($i = 1; $i <= $request->nombre_enfants; $i++) {
            $rules['date_naissance_enfant_' . $i] = 'required|date';
            $rules['regime_enfant_' . $i] = 'required';
         }
      }
      //step 2 validation rules
      $rules['nom'] = 'required';
      $rules['prenom'] = 'required';
      $rules['code_postal'] = 'required';
      $rules['ville'] = 'required';

      $rules['email'] = 'required|email|unique:personnes,email,' . Session::get('client')->id;

      $rules['telephone'] = 'required';
      $rules['date_effet'] = 'required';
      $validator = Validator::make($request->all(), $rules);

      if($validator->fails()) {
         return response()->json(['errors' => $validator->errors()]);
      } else {
         try {

            DB::beginTransaction();
            //modification prospect
            $personne = Personne::findOrFail($request->personne_id);
            $personne->update([
               'nom' => $request->nom,
               'prenom' => $request->prenom,
               'civilite_id' => $request->civilite_prospect,
               'date_naissance' => $request->date_naissance_prospect,
               'regime_id' => $request->regime_prospect,
               'email' => $request->email,
               'numero_securite_sociale' => $request->numero_securite_sociale
            ]);
            //modification details prospect
            $details_personne = Details_personne::findOrFail($personne->details->id);
            $details_personne->update([
               'telephone_1' => $request->telephone,
               'code_postal' => $request->code_postal,
               'ville_id' => $request->ville,
               'adresse' => $request->adresse,
               'email' => $request->email,
            ]);
            //modification du conjoint
            //si nombre_adultes = 2 (conjoit)
            if($request->nombre_adultes == "2" && !empty($personne)) {
               $data_conjoint = [
                  'civilite_id' => $request->civilite_conjoint,
                  'date_naissance' => $request->date_naissance_conjoint,
                  'regime_id' => $request->regime_conjoint,
                  'numero_securite_sociale' => $request->numero_securite_sociale_conjoint
               ];
               if(!empty($personne->conjoint()[0]->id)) {
                  $conjoint = Personne::findOrFail($personne->conjoint()[0]->id);
                  $conjoint->update($data_conjoint);
               } else {
                  $conjointId = Personne::create($data_conjoint)->id;
                  Personne_personne::create(['personne_id' => $personne->id, 'personne_concerne_id' => $conjointId, 'type_relation' => 'conjoint']);
               }
            } else {
               //si nombre_adultes = 1 (pas de conjoint)
               if(!empty($personne->conjoint()[0]->id)) {
                  $idc = $personne->conjoint()[0]->id;
                  $conjoint = Personne::findOrFail($personne->conjoint()[0]->id);
                  $conjoint->delete();

                  Personne_personne::where('personne_id', '=', $personne->id)
                     ->where('personne_concerne_id', '=', $idc)
                     ->where('type_relation', '=', 'conjoint')
                     ->delete();
               }
            }

            //modification fiche
            $fiche = Fiche::findOrFail($request->fiche_id);
            $fiche->update(['date_rappel' => null, 'personne_id' => $personne->id, 'etat_id' => 1, 'equipes_autorisees' => '', 'date_effet' => $request->date_effet]);

            //modification simulation
            //$simulation = Simulation::findOrfail($fiche->simulation->id);
            //$simulation->update(['user_id' => $request->user_id, 'date_effet' => $request->date_effet]);

            //modification enfants
            $enfants_actuelles = $personne->enfants();
            $new_enfants = [];

            for($i = 1; $i <= $request->nombre_enfants; $i++) {
               if($request->has('id_enfant_' . $i) && $request->{'id_enfant_' . $i} != "") {
                  $enfant = Personne::findOrFail($request->{'id_enfant_' . $i});
                  $enfant->update([
                     'date_naissance' => $request->{'date_naissance_enfant_' . $i},
                     'regime_id' => $request->{'regime_enfant_' . $i}
                  ]);
                  array_push($new_enfants, (int)$request->{'id_enfant_' . $i});
               } else {
                  if($request->has('date_naissance_enfant_' . $i)) {
                     $enfantId = Personne::create([
                        'date_naissance' => $request->{'date_naissance_enfant_' . $i},
                        'regime_id' => $request->{'regime_enfant_' . $i}
                     ])->id;
                     Personne_personne::create(['personne_id' => $personne->id, 'personne_concerne_id' => $enfantId, 'type_relation' => 'enfant']);
                     array_push($new_enfants, $enfantId);
                  }
               }
            }

            if(Session::get('user')->type == 'user') {
               Historique::create(['user_id' => Session::get('user')->id, 'fiche_id' => $request->fiche_id, 'action_id' => 13, 'vue' => false]);
            } else {
               Historique::create(['personne_id' => Session::get('user')->id, 'fiche_id' => $request->fiche_id, 'action_id' => 12, 'vue' => false]);
            }

            if(!empty($enfants_actuelles)) {
               foreach($enfants_actuelles as $enfant) {
                  if(!in_array($enfant->id, $new_enfants)) {
                     $enfant = Personne::where('id', '=', $enfant->id)->first();
                     $idEnfantToDelete = $enfant->id;
                     $enfant->delete();
                     Personne_personne::where('personne_concerne_id', '=', $idEnfantToDelete)
                        ->where('type_relation', '=', 'enfant')
                        ->delete();
                  }
               }
            }

            //verification banque ou creation
            if($request->has('banque_nom') && $request->banque_nom != null) {
               $banque = Banque::where('nom', '=', $request->banque_nom)->first();
               if($banque != null) {
                  $banqueId = $banque->id;
               } else {
                  $banqueId = Banque::create(['nom' => $request->banque_nom, 'adresse' => NULL, 'ville_id' => NULL])->id;
               }
            }


            if($request->has('devis_id')) {
               //modification ou creation compte de paiement
               if($request->has('compte_id') && $request->compte_id != null) {
                  $compte = Compte::findOrFail($request->compte_id);
                  $compte->update(['adresse_tt' => $request->adresse_titulaire_compte, 'code_postal_tt' => $request->code_postale_titulaire_compte, 'nom' => $request->nom_titulaire_compte, 'prenom' => $request->prenom_titulaire_compte, 'ville_id_tt' => $request->ville_titulaire_compte, 'bic' => $request->bic, 'numero_carte' => 0, 'iban' => $request->iban, 'adresse' => $request->banque_adresse, 'banque_id' => $banqueId, 'ville_id' => $request->banque_ville]);
               } else {
                  $nouveau_compte_id = Compte::create(['adresse_tt' => $request->adresse_titulaire_compte, 'code_postal_tt' => $request->code_postale_titulaire_compte, 'fiche_id' => $fiche->id, 'nom' => $request->nom_titulaire_compte, 'prenom' => $request->prenom_titulaire_compte, 'ville_id_tt' => $request->ville_titulaire_compte, 'personne_id' => $fiche->personne->id, 'bic' => $request->bic, 'numero_carte' => 0, 'iban' => $request->iban, 'adresse' => $request->banque_adresse, 'banque_id' => $banqueId, 'ville_id' => $request->banque_ville]);
               }
            }
            //modification de devis
            if($request->has('devis_id')) {
               $devis = Devis::findOrFail($request->devis_id);
               $devis->update(['date_prelevement' => $request->date_prelevement]);


               $data_signature = [
                  'merchant_id' => '14000663000000',
                  'application_key' => '0c135b7f2c0f05d54ccc47441267a19a',
                  'transaction_id' => '',
                  'customer_lastname' => $fiche->personne->nom,
                  'customer_firstname' => $fiche->personne->prenom,
                  'customer_email' => $fiche->personne->details->email,
                  'return_email' => '',
                  'merchant_logo' => '',
                  'cancel_return_url' => '',
                  'normal_return_url' => '',
                  'response_return_url' => '',
                  'doc_signature_url' => url('/pdf/pdf-contrat.php?f=' . $fiche->id . '&d=' . $request->devis_id),
                  //'doc_signature_url' => 'http://196.92.5.31:229/fpdm/ex-array.php?d='.$request->devis_id."&f=".$fiche->id,
                  //'doc_signature_url' => 'http://196.92.5.31:229/',
                  'doc_horodatage_url' => '',
               ];
            }

            DB::commit();
            Session::flash('message', 'les informations ont été mises à jour');
            Session::flash('alert-class', 'alert-success');
            Session::flash('data_signature', $data_signature);
         } catch(\Exception $e) {
            DB::rollback();
            Session::flash('message', $e->getMessage());
            Session::flash('alert-class', 'alert-warning');
            Session::flash('data_siganture', []);
         }

         return redirect()->back();
      }
   }

   //affichage des devis
   public function listeDevis() {
      $titre = "ACS Acs assurance - Mes devis";
      $simulationIds = array();
      $personne_id = Session::get('user')->id;
      $fiche = Fiche::where('personne_id', '=', $personne_id)
         ->first();
      if(is_null($fiche->simulations)) {
         abort(403);
      }
      foreach($fiche->simulations as $simulation) {
         array_push($simulationIds, $simulation->id);
      }
      $liste_devis = Devis::whereIn('simulation_id', $simulationIds)->get();
      return view('espace-client.devis.liste-devis', compact('titre', 'liste_devis'));
   }

   //Souscrire (devis verification)
   public function devisVerification($path, $user_type, $token, $fiche_id, $devis_id, $formule_id) {

      if($user_type == "c") {
         $personne = Personne::where(DB::raw('md5(id)'), $token)->first();

         if($personne != null) {
            $personne->type = 'client';
            Session::put('user', $personne);
         } else {
            abort(403);
         }
      } elseif($user_type == "u") {
         $user = User::where('remember_token', $token)->first();
         if($user != null) {
            $user->type = 'user';
            Session::put('user', $user);
         } else {
            abort(403);
         }
      } else {
         abort(404);
      }

      $devis = Devis::findOrFail($devis_id);
      $fiche = Fiche::findOrFail($fiche_id);
      $formule = Formule::findOrFail($formule_id);
      $compte = Compte::where('fiche_id', '=', $fiche->id)->first();

      if($fiche->id != $devis->fiche_id) {
         abort(404);
      }
      $civilites = $this->civilites;
      $regimes = $this->regimes;
      return view('espace-client.devis.devis-verification', compact('compte', 'fiche', 'devis', 'formule', 'regimes', 'civilites'));
   }

   public function modificationPasswordForm() {
      return view('espace-client.modification-password');
   }

   public function modificationPassword(Request $request) {
      $this->validate($request, [
         'mot_de_passe_courant' => 'required|min:6',
         'mot_de_passe' => 'required|min:6|confirmed|different:mot_de_passe_courant',
         'mot_de_passe_confirmation' => 'required|min:6'
      ]);

      $personne = Personne::where('password', '=', $request->mot_de_passe_courant)
         ->where('id', '=', Session::get('user')->id)
         ->first();
      if($personne == null) {
         Session::flash('message', "le mot de passe courant incorrect");
         Session::flash('alert-class', 'alert-warning');
         return \redirect()->back();
      } else {
         $personne->password = $request->mot_de_passe;
         $personne->password_updated_at = date("Y-m-d H:i:s");
         $personne->save();
         Session::flash('message', "votre demande a été bien traité");
         Session::flash('alert-class', 'alert-success');
         return \redirect('espace-client/mes-devis');
      }

   }

   public function getContactDetails(Request $request) {
      $this->validate($request, [
         'email' => 'required|email',
         'nom' => 'required',
         'motif' => 'required',
         'message' => 'required|min:20',
         'captcha' => 'required|captcha'
      ],
         ['captcha.captcha' => 'Code captcha invalide.']);


      $message_data = [
         'nom' => $request->nom,
         'email' => $request->email,
         'message' => "Email : " . $request->email . "\r\n" .
            "Nom  : " . $request->nom . "\r\n" .
            "Téléphone : " . $request->telephone . "\r\n" .
            "Motif de message : " . $request->motif . "\r\n" .
            'Message : ' . $request->message
      ];
      try {
         DB::beginTransaction();
         Mail::raw($message_data['message'], function($message) use ($message_data) {
            $message->to("contact@acsassrance.com");
            $message->cc("mhamed.erraji@acsassurance.com");
            $message->subject('[Acs Assurance] Nouveau message : ' . $message_data['email']);
         });

         $message = Message::create(['emetteur_id'=>NULL,'emetteur_email'=>$request->email,'message'=>$message_data['message'],'type_id'=>1]);
         User_message::create(['message_id'=>$message->id,'user_id'=>'0']);

         DB::commit();
         Session::flash('message', 'Votre demande a été bien traitée');
         Session::flash('alert-class', 'alert-success');
      } catch(\Exception $exception) {
         DB::rollBack();
         Session::flash('message', 'Une erreur est survenue ');
         Session::flash('alert-class', 'alert-warning');
      }
      return \redirect()->back();


   }

   //captcha refresh
   public function refreshCaptcha() {
      //return response()->json(['captcha' => captcha_img()]);
      return captcha_img();
   }
}
