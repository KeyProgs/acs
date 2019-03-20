<?php

namespace App\Http\Controllers;

use App\Banque;
use App\Civilite;
use App\Compagnie;
use App\Compte;
use App\Devis;
use App\Fiche;
use App\Fiche_etat;
use App\Formule;
use App\Gamme;
use App\Historique;
use App\Mode_paiement;
use App\Personne;
use App\Simulation;
use App\Sous_volet;
use App\Volet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class DevisController extends GlobaleController
{
   public function devisInfos($path,int $devis_id) {
      $data = $this->initialisationDevis($devis_id);
      return view('espace-client.devis.devis-infos', compact('data'));
   }
    //paramétrable function for (envoyerdevis && contratInfos && souscriptionsteeps)
    public function checkDevis($devis_id, $date_prelevement, $formule_id, $fiche_id, $action_id, $reduction, $cotisation, $mode_id)
    {
        $fiche = Fiche::findOrfail($fiche_id);
        $compte = Compte::where('fiche_id', '=', $fiche->id)->first();

        if ($devis_id != null) {
            $idDevis = $devis_id;
            $devis = Devis::findOrFail($devis_id);
            $devis->update(['user_id' => Auth::user()->id, 'mode_id' => $mode_id, 'date_prelevement' => $date_prelevement, 'formule_id' => $formule_id, 'fiche_id' => $fiche->id, 'compte_id' => $compte->id, 'cotisation' => $cotisation, 'reduction' => $reduction, 'numero_contrat' => 0, 'date_debut' => $fiche->simulation->date_effet, 'date_fin' => NULL, 'fiche_id' => $fiche->id, 'fiche_etat_id' => 35]);
            Historique::create(['user_id' => Auth::user()->id, 'fiche_id' => $fiche->id, 'action_id' => $action_id, 'description' => '<a href="/devis/' . $devis->id . '">Devis N° ' . $devis->id . ' a été modifier et envoyé</a>', 'vue' => 1]);
        } else {
            $idDevis = Devis::create(['user_id' => Auth::user()->id, 'mode_id' => $mode_id, 'date_prelevement' => $date_prelevement, 'formule_id' => $formule_id, 'fiche_id' => $fiche->id, 'compte_id' => @$compte->id, 'cotisation' => $cotisation, 'reduction' => $reduction, 'numero_contrat' => 0, 'simulation_id' => $fiche->simulation->id, 'date_debut' => $fiche->simulation->date_effet, 'date_fin' => NULL, 'fiche_id' => $fiche->id, 'fiche_etat_id' => 35])->id;
            Historique::create(['user_id' => Auth::user()->id, 'fiche_id' => $fiche->id, 'devis_id' => $idDevis, 'action_id' => $action_id, 'description' => '<a href="/devis/' . $idDevis . '">Devis N° ' . $idDevis . ' a été envoyé</a>', 'vue' => 1]);
        }
        //$this->envoyerMailDevis($idDevis);
        return $idDevis;
    }

    //Envoyer Devis Button function
    public function buttonEnvoyerDevis($devis_id, $date_prelevement, $formule_id, $fiche_id, $action_id, $reduction, $cotisation, $mode_id)
    {
        //$this->envoyerMailDevis($devis_id);
        $this->checkDevis($devis_id, $date_prelevement, $formule_id, $fiche_id, $action_id, $reduction, $cotisation, $mode_id);
    }

    //Souscrire Button function
    public function ButtonSouscrireDevis($devis_id, $date_prelevement, $formule_id, $fiche_id, $action_id, $reduction, $cotisation, $mode_id)
    {
        $this->checkDevis($devis_id, $date_prelevement, $formule_id, $fiche_id, $action_id, $reduction, $cotisation, $mode_id);
        //for ajax
    }

    //envoyer un e-mail au prospect
    public function envoyerMailDevis($devis_id = null)
    {
        $fiche = Fiche::find(Devis::find($devis_id)->fiche_id);


        $data = $this->initialisationDevis($devis_id);
        if (Mail::send('devis.devis1', ['data' => $data], function ($message) use ($data) {

            $message->to($data['prospect']->email , $data['prospect']->civilite->valeur . ' ' . $data['prospect']->nom . ' ACS ASSURANCE votre devis')
                ->cc()
                ->subject('acsAssurance Votre devis ' . $data['devis']->formule->nom . ' à ' . $data['devis']->cotisation . '/mois')
                ->attach('http://crm.acsassurance.com/img/acs.jpg')
                ->from('gestion@acsassurance.com', 'GESTION ACS ASSURANCE');
        })) return $this->sendResponse('200', 'Email Envoyé à ' . $data['prospect']->email);
        else return $this->sendResponse('200', 'Email ERREUR à ' . $data['prospect']->email);
    }

    //get all devis data by id
    public function initialisationDevis(int $devisId)
    {
        $prospect = null;
        $conjoint = null;
        $devis = Devis::where('id', '=', $devisId)->first();
        if (!isset($devis->id)) {
            //dd("Le devis N°:  n'a pas été enregistré");
        }
        $formule = Formule::where('id', '=', $devis->formule_id)->first();
        $gamme = Gamme::where('id', '=', $formule->gamme_id)->first();
        $compagnie = Compagnie::where('id', '=', $gamme->compagnie_id)->first();
        $simulation = Simulation::where('id', '=', $devis->simulation_id)->first();
        $fiche = Fiche::where('id', '=', $devis->fiche_id)->first();
        $personne = Personne::where('id', '=', $fiche->personne_id)->first();
        $conjoint = $personne->conjoint();
        $nbenfants = $personne->conjoint();

        $volets = Volet::all();
        $ArrayVolets = null;

        foreach ($volets as $volet) {

            $SousVolets = Sous_volet::where('volet_id', '=', $volet->id)->get();

            foreach ($SousVolets as $key => $sousVolet) {
                $sousVolet->garantie = DB::table('valeurs')
                    ->where('formule_id', '=', $formule->id)
                    ->where('sous_volet_id', '=', $sousVolet->id)->pluck('valeur')->first();

            }
            $ArrayVolets[$volet->valeur] = $SousVolets;
        }
        //dd($formule->id,$ArrayVolets);

        return $data = [
            'prospect' => $personne,
            'conjoint' => $conjoint,
            'nbenfants' => $nbenfants,
            'compagnie' => $compagnie,
            'gamme' => $gamme,
            'formule' => $formule,
            'prix' => $devis->cotisation,
            'devis' => $devis,
            'ArrayVolets' => $ArrayVolets,
            'fiche' => $fiche,
        ];
    }

    public function devis(int $devis_id, int $formule_id = null)
    {
        $data = $this->initialisationDevis($devis_id);
        return view('devis.devis', compact('data'));
    }

    public function newDevis(int $devis_id, int $formule_id = null)
    {
        $data = $this->initialisationDevis($devis_id);
        return view('devis.devis1', compact('data'));
    }

    public function souscriptionsteeps($fiche_id, $devis_id, $formule_id = null)
    {
        $data = $this->initialisationDevis($devis_id);
        return view('client.devis.devis-verification', compact('data'));
    }

    //afficher le modal de contrat
    public function contratInfosForm(Request $request)
    {
        $user = Auth::user();
        $fiche = Fiche::findOrFail($request->fiche_id);
        $formule_id = $request->formule_id;
        $has_check_etat = $request->has_check_etat;
        $devis = DB::table('devis')
            ->select('devis.*')
            ->join('simulations', 'simulations.id', '=', 'devis.simulation_id')
            ->join('fiches', 'fiches.id', '=', 'simulations.fiche_id')
            ->join('users', 'users.id', '=', 'devis.user_id')
            ->where('devis.formule_id', '=', $formule_id)
            ->where('fiches.id', '=', $fiche->id)
            ->where('devis.user_id', '=', $user->id)
            ->whereYear('devis.date_debut', '=', substr($fiche->date_effet, 0, 4))
            ->first();
        $modes_paiement = Mode_paiement::all();
        return view('includes.tarificateur.contrat-modal', compact('devis', 'formule_id', 'fiche', 'modes_paiement', 'has_check_etat'));
    }

    //enregistrer le modal de contrat
    public function contratInfos(Request $request)
    {
        $cotisation = null;
        $action_id = 8;
        $idDevis = null;
        $rules['fiche_id'] = 'required';
        $rules['mode_id'] = 'required';

        if ($request->has('cotisation')) {
            $rules['formule_id'] = 'required';
            $rules['cotisation'] = 'numeric|required';
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            try {
                $modif = false;
                DB::beginTransaction();
                $fiche = Fiche::findOrfail($request->fiche_id);
                $compte = Compte::where('fiche_id', '=', $fiche->id)->first();
                $devis_id = null;

                if ($compte != null) {
                    if (isset($request->conjoint_id) && $request->conjoint_id != '') {
                        $personne = Personne::find($request->conjoint_id);
                        $personne->update(['numero_securite_sociale' => $request->tarif_numero_securite_sociale_conjoint]);
                    }

                    $personne = Personne::find($request->prospect_id);
                    $personne->update(['numero_securite_sociale' => $request->tarif_numero_securite_sociale]);
                    $cotRedArray = $this->getCotRed($request->formule_id, $request->fiche_id);

                    if (isset($request->cotisation) && $request->cotisation != '') {
                        $cotisation = $request->cotisation;
                        $action_id = 9;
                    } else {
                        $cotisation = $cotRedArray['Cot'];
                    }

                    if ($request->has('devis_id')) {
                        $modif = true;
                        $devis_id = $request->devis_id;
                    }

                    $idDevis = $this->buttonEnvoyerDevis($devis_id, $request->date_prelevement, $request->formule_id, $request->fiche_id, $action_id, $cotRedArray['Red'], $cotisation, $request->mode_id);

                    $formule = Formule::find($request->formule_id);
                    DB::commit();
                    if ($modif) {
                        // return $this->sendResponse('', 'Votre Modification a été bien traitée');
                        return $this->sendResponse($idDevis, 'Le devis ' . $formule->nom . ' abien été  Modifié et   envoyé sur l\'adresse : ' . $fiche->personne->email);

                    } else {
                        return $this->sendResponse($idDevis, 'Le devis ' . $formule->nom . ' abien été envoyé sur l\'adresse :  ' . $fiche->personne->email);
                    }
                } else {
                    return $this->sendResponse('', 'Mode de paiement vide !');
                }
            } catch (\Exception $e) {
                DB::rollback();
                return $this->sendError($e->getMessage());
            }
        }
    }

    //check fiche etat (select)
    public function checkFicheEtat($fiche_etat_id)
    {
        $fiche_etat = Fiche_etat::where('id', '=', $fiche_etat_id)
            ->where('id', '=', 38)
            ->first();
        if ($fiche_etat != null) {
            return $this->sendResponse(['contrat' => true], '');
        } else {
            return $this->sendResponse(['contrat' => false], '');
        }
    }

    //afficher le modal de paiement
    public function paiementInfosForm($fiche_id, $mode = null)
    {
        $has_mode_paiement = false;
        if (isset($mode)) {
            $has_mode_paiement = true;
        }
        $fiche = Fiche::findOrFail($fiche_id);
        $civilites = Civilite::all();
        return view('includes.tarificateur.paiement-modal', compact('fiche', 'civilites', 'has_mode_paiement'));
    }

    //enregistrer le modal de paiement
    public function paiementInfos(Request $request)
    {
        $modif = false;
        $nouveau_compte_id = null;
        $rules = [
            'nom_tt' => 'required',
            'prenom_tt' => 'required',
            'ville_id_tt' => 'required',
            //'code_postal_tt' => 'required',
            'adresse_tt' => 'required',

            'banque_nom' => 'required',
            'adresse_compte' => 'required',
            'ville_id_compte' => 'required',
            'bic_compte' => 'required',
            'iban_compte' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {

            try {
                DB::beginTransaction();
                //verifier la banque
                $banque = Banque::where('nom', '=', $request->banque_nom)->first();
                if ($banque != null) {
                    $banqueId = $banque->id;
                } else {
                    $banqueId = Banque::create(['nom' => $request->banque_nom, 'adresse' => NULL, 'ville_id' => NULL])->id;
                }

                if ($request->has('compte_id') && $request->compte_id != null) {
                    $modif = true;
                    //modification du compte
                    $compte = Compte::findOrFail($request->compte_id);
                    $compte->update(['adresse_tt' => $request->adresse_tt, 'code_postal_tt' => $request->code_postal_tt, 'nom' => $request->nom_tt, 'prenom' => $request->prenom_tt, 'ville_id_tt' => $request->ville_id_tt, 'bic' => $request->bic_compte, 'numero_carte' => 0, 'iban' => $request->iban_compte, 'adresse' => $request->adresse_compte, 'banque_id' => $banqueId, 'ville_id' => $request->ville_id_compte]);
                } else {
                    //creation d'un nouveau compte
                    $nouveau_compte_id = Compte::create(['adresse_tt' => $request->adresse_tt, 'code_postal_tt' => $request->code_postal_tt, 'fiche_id' => $request->fiche_id, 'nom' => $request->nom_tt, 'prenom' => $request->prenom_tt, 'ville_id_tt' => $request->ville_id_tt, 'personne_id' => NULL, 'bic' => $request->bic_compte, 'numero_carte' => 0, 'iban' => $request->iban_compte, 'adresse' => $request->adresse_compte, 'banque_id' => $banqueId, 'ville_id' => $request->ville_id_compte]);
                }
                DB::commit();
                if ($modif) {
                    return $this->sendResponse('', 'Votre Modification a été bien traitée');
                } else {
                    return $this->sendResponse($nouveau_compte_id, 'Votre demande a été bien traitée');
                }
            } catch (\Exception $e) {
                DB::rollback();
                return $this->sendError($e->getMessage());
            }

        }
    }

    //Souscrire function
    public function souscrireDevis($fiche_id, $formule_id)
    {
        //check if devis existe for this user
        $cotRedArray = $this->getCotRed($formule_id, $fiche_id);
        $devis_id = null;
        $action_id = 8;//envoi devis
        $fiche = Fiche::findOrFail($fiche_id);
        $user = Auth::user();

        $devis = DB::table('devis')
            ->select('devis.*')
            //->join('simulations', 'simulations.id', '=', 'devis.simulation_id')
           ->join('fiches', 'fiches.id', '=', 'devis.fiche_id')
            ->join('users', 'users.id', '=', 'devis.user_id')
            ->where('devis.formule_id', '=', $formule_id)
            ->where('fiches.id', '=', $fiche->id)
            ->where('devis.user_id', '=', $user->id)
            ->whereYear('devis.date_debut', '=', substr($fiche->date_effet, 0, 4))
            ->first();
//dd($devis);


        if ($devis != null) {
            $devis_id = $devis->id;
        }
        //create or update devis (and send mail)
        $idDevis = $this->checkDevis($devis_id, NULL, $formule_id, $fiche_id, $action_id, $cotRedArray['Red'], $cotRedArray['Cot'], @$devis->mode_id);
        return $this->sendResponse($idDevis, '');
    }


}
