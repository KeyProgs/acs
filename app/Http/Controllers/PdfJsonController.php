<?php

namespace App\Http\Controllers;

use App\Devis;
use App\Fiche;
use App\FPDM;
//use App\Libraries\FPDM;
use App\Gamme;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use mikehaertl\pdftk\Pdf;

class PdfJsonController extends GlobaleController {

   public function getCrmCotisation($fiche_id, $formule_id) {
      $url = env("CRM_URL") . 'tarificateur/' . $fiche_id . '/' . $formule_id;
      $json = file_get_contents($url);
      $data = json_decode($json, false, 512, JSON_UNESCAPED_UNICODE);
      return $data;
   }

   public function getTableDataById($table_name, $field, $value) {
      $table_name = ucfirst($table_name);
      $table_name = "App\\$table_name";
      $data = $table_name::where($field, $value)->get();
      return response()->json($data);
   }

   public function getPersonneSexe($personne_type, $civilite_id, $array) {
      ${$personne_type . "_sexe_f"} = ${$personne_type . "_sexe_m"} = " ";
      switch($civilite_id) {
         case 1 :
            ${$personne_type . "_sexe_f"} = "X";
            break;
         case 2 :
            ${$personne_type . "_sexe_f"} = "X";
            break;
         case 4 :
            ${$personne_type . "_sexe_m"} = "X";
            break;
         default:
            ${$personne_type . "_sexe_f"} = ${$personne_type . "_sexe_m"} = " ";
            break;
      }
      $array[$personne_type . "_sexe_f"] = ${$personne_type . "_sexe_f"};
      $array[$personne_type . "_sexe_m"] = ${$personne_type . "_sexe_m"};
      return $array;
   }

   public function getGammeDatePrelevement($gamme_id) {
      $gamme = Gamme::find($gamme_id);
      $gamme_dates_prelevement_array = (explode(",", $gamme->date_prelevement));
      return $gamme_dates_prelevement_array;
   }

   public function getPdfData($fiche_id, $devis_id) {

      $devis = Devis::find($devis_id);
      //dd($devis->formule->gamme);
      $fiche = Fiche::find($fiche_id);
      if($devis->fiche_id != $fiche->id) {
         return response()->json('Not Authorized');
      }


      $DATA_ARRAY = [
         'date_effet' => date("dmY", strtotime($fiche->date_effet)),
         'conseiller_nom' => $fiche->user->nom . " " . $fiche->user->prenom,
         'nouvelle_affaire' => "X",
         'avenant' => " ",
         //prospect
         'prospect_nom' => $fiche->personne->nom,
         'prospect_prenom' => $fiche->personne->prenom,
         'prospect_date_naissance' => date("d/m/Y", strtotime($fiche->personne->date_naissance)),
         'prospect_numero_securite_sociale' => str_replace("-", "", $fiche->personne->numero_securite_sociale),
         'prospect_numero_affiliation' => str_replace("-", "", $fiche->personne->numero_affiliation),
         'prospect_regime' => $fiche->personne->regime->libelle,
         'prospect_sexe_m' => " ",
         'prospect_sexe_f' => " ",
         'prospect_ayant_droit_principal' => "X",
         'prospect_ayant_droit_conjoint' => " ",
         //prospect details
         'prospect_telephone' => $fiche->personne->details->telephone_1,
         'prospect_email' => $fiche->personne->details->email,
         'prospect_adresse' => "           " . $fiche->personne->details->adresse,
         'prospect_code_postal' => $fiche->personne->details->code_postal,
         'prospect_ville' => $fiche->personne->details->laville->name,
         //conjoint informations
         'conjoint_nom' => " ",
         'conjoint_prenom' => " ",
         'conjoint_date_naissance' => " ",
         'conjoint_numero_securite_sociale' => " ",
         'conjoint_numero_affiliation' => " ",
         'conjoint_regime' => " ",
         'conjoint_sexe_m' => " ",
         'conjoint_sexe_f' => " ",
         'conjoint_ayant_droit_principal' => " ",
         'conjoint_ayant_droit_conjoint' => " ",
         //enfant_1
         'enfant_1_nom' => " ",
         'enfant_1_prenom' => " ",
         'enfant_1_date_naissance' => " ",
         'enfant_1_numero_securite_sociale' => " ",
         'enfant_1_numero_affiliation' => " ",
         'enfant_1_regime' => " ",
         'enfant_1_sexe_m' => " ",
         'enfant_1_sexe_f' => " ",
         'enfant_1_ayant_droit_principal' => " ",
         'enfant_1_ayant_droit_conjoint' => " ",
         //enfant_2
         'enfant_2_nom' => " ",
         'enfant_2_prenom' => " ",
         'enfant_2_date_naissance' => " ",
         'enfant_2_numero_securite_sociale' => " ",
         'enfant_2_numero_affiliation' => " ",
         'enfant_2_regime' => " ",
         'enfant_2_sexe_m' => " ",
         'enfant_2_sexe_f' => " ",
         'enfant_2_ayant_droit_principal' => " ",
         'enfant_2_ayant_droit_conjoint' => " ",
         //enfant_3
         'enfant_3_nom' => " ",
         'enfant_3_prenom' => " ",
         'enfant_3_date_naissance' => " ",
         'enfant_3_numero_securite_sociale' => " ",
         'enfant_3_numero_affiliation' => " ",
         'enfant_3_regime' => " ",
         'enfant_3_sexe_m' => " ",
         'enfant_3_sexe_f' => " ",
         'enfant_3_ayant_droit_principal' => " ",
         'enfant_3_ayant_droit_conjoint' => " ",
         //enfant_4
         'enfant_4_nom' => " ",
         'enfant_4_prenom' => " ",
         'enfant_4_date_naissance' => " ",
         'enfant_4_numero_securite_sociale' => " ",
         'enfant_4_numero_affiliation' => " ",
         'enfant_4_regime' => " ",
         'enfant_4_sexe_m' => " ",
         'enfant_4_sexe_f' => " ",
         'enfant_4_ayant_droit_principal' => " ",
         'enfant_4_ayant_droit_conjoint' => " ",
         //enfant_5
         'enfant_5_nom' => " ",
         'enfant_5_prenom' => " ",
         'enfant_5_date_naissance' => " ",
         'enfant_5_numero_securite_sociale' => " ",
         'enfant_5_numero_affiliation' => " ",
         'enfant_5_regime' => " ",
         'enfant_5_sexe_m' => " ",
         'enfant_5_sexe_f' => " ",
         'enfant_5_ayant_droit_principal' => " ",
         'enfant_5_ayant_droit_conjoint' => " ",
         //formule informations
         'formule_id' => $devis->formule->id,
         'formule_nom' => $devis->formule->nom,
         'gamme_id' => $devis->formule->gamme->id,
         'gamme_nom' => $devis->formule->gamme->nom,
         'compagnie_id' => $devis->formule->gamme->compagnie->id,
         'compagnie_nom' => $devis->formule->gamme->compagnie->nom,
         //devis infos
         'cotisation_1' => " ",
         'cotisation_2' => " ",
         'cotisation_3' => " ",
         'cotisation_4' => " ",
         'cotisation_5' => " ",
         'cotisation_6' => " ",
         'cotisation_7' => " ",
         'cotisation_sous_total' => " ",
         'cotisation_mensuelle' => " ",

         'mode_prelevement' => ' ',
         'mode_cheque' => ' ',

         //============================= Mandat de Prélèvement SEPA ===========================
         'nom_prenom_compte' => $fiche->compte->nom . ' ' . $fiche->compte->prenom,
         'adresse_compte' => $fiche->compte->adresse_tt,
         'code_postal_compte' => $fiche->compte->code_postal_tt,
         'ville_compte' => $fiche->compte->ville_tt->name,
         'iban_compte' => $fiche->compte->iban,
         'bic_compte' => $fiche->compte->bic,

         'prospect_compte_nom_prenom' => $fiche->personne->nom . ' ' . $fiche->personne->prenom,
         'prospect_compte_adresse' => $fiche->personne->details->adresse,
         'prospect_compte_code_postal' => $fiche->personne->details->code_postal,
         'prospect_compte_ville' => $fiche->personne->details->laville->name,

      ];
      /*
       *
       *
       *
       *
       *
       *
       *
       *
       *
       */
      //=========================== dates prelevement de la gammes
      $gamme_dates_prelevement_array = $this->getGammeDatePrelevement($devis->formule->gamme->id);
      foreach($gamme_dates_prelevement_array as $date_prelevement) {
         if($date_prelevement == $devis->date_prelevement) {
            $DATA_ARRAY["date_prelevement_" . $date_prelevement] = "X";
         } else {
            $DATA_ARRAY["date_prelevement_" . $date_prelevement] = " ";
         }
      }
      //remplire le devis
      if($devis->mode_id != "1") {
         $DATA_ARRAY['mode_prelevement'] = 'X';
      } elseif($devis->mode_id != "2") {
         $DATA_ARRAY['mode_cheque'] = 'X';
      }
      //=========================== definir le sexe de prospect
      $DATA_ARRAY = $this->getPersonneSexe('prospect', $fiche->personne->civilite_id, $DATA_ARRAY);

      if(!empty($devis->formule->gamme->formules)) {
         $formuleIndex = 1;
         foreach($devis->formule->gamme->formules as $formule) {
            if($formule->id == $devis->formule_id) {
               $DATA_ARRAY['formule_' . $formuleIndex] = "X";
            } else {
               $DATA_ARRAY['formule_' . $formuleIndex] = " ";
            }
            $formuleIndex++;
         }
      }

      //========================== remplire les informations du conjoint
      if(!empty($fiche->personne->conjoint())) {
         $conjoint = \App\Personne::find($fiche->personne->conjoint()->id);
         $DATA_ARRAY['conjoint_nom'] = $conjoint->nom;
         $DATA_ARRAY['conjoint_prenom'] = $conjoint->prenom;
         $DATA_ARRAY['conjoint_date_naissance'] = date("d/m/Y", strtotime($conjoint->date_naissance));
         $DATA_ARRAY['conjoint_numero_securite_sociale'] = str_replace("-", "", $conjoint->numero_securite_sociale);
         $DATA_ARRAY['conjoint_numero_affiliation'] = str_replace("-", "", $conjoint->numero_affiliation);
         $DATA_ARRAY['conjoint_regime'] = str_replace("-", "", $conjoint->regime->libelle);
         $DATA_ARRAY['conjoint_ayant_droit_conjoint'] = "X";
         //=========================== definir le sexe de conjoint
         $DATA_ARRAY = $this->getPersonneSexe('conjoint', $conjoint->civilite_id, $DATA_ARRAY);
         //$DATA_ARRAY = $this->getPersonneSexe('conjoint', $conjoint->civilite_id, $DATA_ARRAY);
      }

      //========================== remplire les informations des enfants
      if(!empty($fiche->personne->enfants())) {
         $enfantIndex = 1;
         foreach($fiche->personne->enfants() as $enfant) {
            $DATA_ARRAY['enfant_' . $enfantIndex . '_nom'] = $enfant->nom;
            $DATA_ARRAY['enfant_' . $enfantIndex . '_prenom'] = $enfant->prenom;
            $DATA_ARRAY['enfant_' . $enfantIndex . '_date_naissance'] = date("d/m/Y", strtotime($enfant->date_naissance));
            $DATA_ARRAY['enfant_' . $enfantIndex . '_numero_securite_sociale'] =  str_replace("-", "", $enfant->numero_securite_sociale);
            $DATA_ARRAY['enfant_' . $enfantIndex . '_numero_affiliation'] =  str_replace("-", "", $enfant->numero_affiliation);

            $DATA_ARRAY = $this->getPersonneSexe('enfant_' . $enfantIndex, $enfant->civilite_id, $DATA_ARRAY);

            //$DATA_ARRAY['enfant_' . $enfantIndex . '_regime'] = $enfant->regime->libelle;
            if($enfant->ayant_droit = "conjoint") {
               $DATA_ARRAY['enfant_' . $enfantIndex . '_ayant_droit_conjoint'] = "X";
            } elseif($enfant->ayant_droit = "prospect") {
               $DATA_ARRAY['enfant_' . $enfantIndex . '_ayant_droit_prospect'] = "X";
            }
            $enfantIndex++;
         }
      }
      /*
       *
       *
       *
       *
       */
      //================================ data web service ========================
      $data_web_service = $this->getCrmCotisation($fiche->id, $devis->formule_id);
      //cotisations
      $cotisationIndex = 1;
      $cotisation_sous_total = 0;
      $DATA_ARRAY['cotisation_mensuelle'] = number_format((float)$data_web_service->data, 2, '.', '');
      foreach($data_web_service->message->Personnes as $personne) {
         $DATA_ARRAY['cotisation_' . $cotisationIndex] = number_format((float)$personne->prix, 2, '.', '');
         $cotisation_sous_total += number_format((float)$personne->prix, 2, '.', '');
         $cotisationIndex++;
      }
      //reductions
      $DATA_ARRAY['cotisation_sous_total'] = $cotisation_sous_total;
      if(isset($data_web_service->message->reduction_famille)) {
         $DATA_ARRAY['reduction_famille'] = 'X';
      }
      if(isset($data_web_service->message->reduction_couple)) {
         $DATA_ARRAY['reduction_couple'] = 'X';
      }
      //renfants bien
      //TODO : ronfont 1 / ronfont 2 / ronfant_mieux_etre / renfont_confort / ronfant_bien_etre_plus / ronfant_bien_etre / reduction_famille / reduction_couple ;
      return response()->json($DATA_ARRAY);
   }

   public function generate_pdf() {
      return view('pdf.pdf-form');
      /*$myvar1 = "tesdtet";
      $myvar2 = '1';
      $url = 'http://196.92.5.31:229/fpdm/ex-array.php';
      $myvars = 'myvar1=' . $myvar1 . '&myvar2=' . $myvar2;

      $ch = curl_init( $url );
      curl_setopt( $ch, CURLOPT_POST, 1);
      curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
      curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt( $ch, CURLOPT_HEADER, 0);
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

      $response = curl_exec( $ch );
      return $response;*/

      /*$fields = array(
          'nom'    => 'M\'hamed',
          'prenom'    => 'Erraji',
          'check' => true,
      );

      $pdf = new FPDM(app_path().'/bulletin_cc.pdf');
      $pdf->Load($fields, false); // second parameter: false if field values are in ISO-8859-1, true if UTF-8
      $pdf->Merge();
      $pdf->Output("D",'bulletin_export.pdf');*/

   }
}

/*$formule = getJson($url . 'api/formule/id/' . $devis["formule_id"]);
$gamme = getJson($url . 'api/gamme/id/' . $formule["gamme_id"]);
$compagnie = getJson($url . 'api/compagnie/id/' . $gamme["compagnie_id"]);
$fiche = getJson($url . 'api/fiche/id/' . $paramFicheId);
$personne = getJson($url . 'api/personne/id/' . $fiche["personne_id"]);
$Ppersonnes = getJson($url . 'api/personne_personne/personne_id/' . $personne["id"]);
$details_personne = getJson($url . 'api/details_personne/personne_id/' . $personne["id"]);
$conseiller = getJson($url . 'api/User/id/' . $fiche["user_id"]);*/
