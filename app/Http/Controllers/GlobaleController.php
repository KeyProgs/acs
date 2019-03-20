<?php

namespace App\Http\Controllers;

use App\Banque;
use App\Civilite;
use App\Compagnie;
use App\Equipe;
use App\Fiche;
use App\Formule;
use App\Gamme;
use App\Profession;
use App\Provenance;
use App\Regime;
use App\Situation_familiale;
use App\User;
use App\User_equipe;
use App\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GlobaleController extends Controller {


   public function listeCivilites() {
      return Civilite::all();
   }


   public function listeRegimes() {
      return Regime::all();
   }


   public function getVilles($code_postale = null) {
      if($code_postale === null) {
         $response = Ville::All();
      } else {
         $response = Ville::where('zip_code', 'like', $code_postale . '%')
            ->get();
      }
      return $this->sendResponse($response, '');
   }

   /*public function listeSituationFamiliales() {
      return Situation_familiale::all();
   }
   public function listeProfessions() {
      return Profession::all();
   }
   public function listeProvenances() {
      return Provenance::all();
   }

   public function listeUsers() {
      return User::all();
   }*/

   //send success message
   public function sendResponse($result, $message) {
      $response = [
         'success' => true,
         'data' => $result,
         'message' => $message,
      ];
      return response()->json($response, 200);
   }

   //send error message
   public function sendError($error, $errorMessages = [], $code = 404) {
      $response = [
         'success' => false,
         'message' => $error,
      ];
      if(!empty($errorMessages)) {
         $response['data'] = $errorMessages;
      }
      return response()->json($response, $code);
   }

   //for mail
   public function setEnvironmentValue($envKey, $envValue) {
      $envFile = app()->environmentFilePath();
      $str = file_get_contents($envFile);

      $oldValue = strtok($str, "{$envKey}=");

      $str = str_replace("{$envKey}={$oldValue}", "{$envKey}={$envValue}\n", $str);

      $fp = fopen($envFile, 'w');
      fwrite($fp, $str);
      fclose($fp);
   }

   public function getListeFichePrioriteIds() {
      $user = User::findOrFail(Auth::user()->id);
      $dbResult = DB::select("/*req*/
select f.id,f.created_at,f.date_rappel,f.note,f.etat_id,
(select TIMESTAMPDIFF(HOUR,f.created_at,NOW())) as anciennete,
(select count(*) FROM historiques where historiques.fiche_id = f.id and historiques.action_id=7 and (historiques.created_at BETWEEN NOW() and DATE_ADD(NOW(), INTERVAL-1 MONTH))) as call_count_last_month,
(select his.created_at from historiques his where his.fiche_id = f.id and his.action_id = 7 order by his.created_at desc limit 1) as last_call_date
from fiches f 	where
   (select count(*) FROM historiques where historiques.fiche_id = f.id and historiques.action_id=7 and DATE_FORMAT(historiques.created_at,\"%Y-%m-%d\") = DATE_FORMAT(NOW(),\"%Y-%m-%d\"))<4 
	and f.etat_id IN (select DISTINCT f.etat_id from fiches f,fiche_etats fe where fe.id = f.etat_id and fe.etat_groupe_id = 1)
	and (SELECT IFNULL((select his.created_at from historiques his where his.fiche_id = f.id and his.action_id = 7 order by his.created_at desc limit 1),DATE_ADD(NOW(), INTERVAL +4 HOUR)))>NOW()
	and (select IFNULL(f.date_rappel,DATE_ADD(NOW(), INTERVAL-1 YEAR)))<NOW()
	and f.user_id = " . $user->id . " order by f.created_at desc");
      return $dbResult;
   }

   public function getListeFichePrioriteData($count) {
      $ficheValues = array();
      $Values = array();
      $currentTime = time();
      $currentDate = date("Y-m-d H:i:s", $currentTime);
      $user = User::findOrFail(Auth::user()->id);

      //$usersIds = $user->getUsersEquipeByUser($user->id);
      //$usersIds = array_map('intval', explode(',', $usersIds));
      //$usersIds = implode("','", $usersIds);

      $dbResult = $this->getListeFichePrioriteIds();
      foreach($dbResult as $key => $value) {
         $ficheValue = 2;
         $diffMinutes = (strtotime($dbResult[$key]->date_rappel) - $currentTime) / 60;
         //$diffHoures = ($currentTime - strtotime($dbResult[$key]->last_call_date)) / 3600;

         if($dbResult[$key]->date_rappel != null && $diffMinutes <= 15 && $diffMinutes > 0) {
            $ficheValue += 8;
         } else {
            if($dbResult[$key]->call_count_last_month == 0) {
               $ficheValue += 0;
            } else {
               /*if($dbResult[$key]->last_call_date != null && $diffHoures > 0 && $diffHoures < 4) {//ignore
                  $ficheValue = 0;
               } else {
                  $ficheValue += $dbResult[$key]->call_count;
               }*/
               $ficheValue += $dbResult[$key]->call_count_last_month;
            }
         }
         if($ficheValue > 0) {
            $Values[] = $ficheValue;
            array_push($ficheValues, ['fiche_id' => $dbResult[$key]->id, 'value' => $ficheValue]);
         }
      }

      array_multisort($Values, SORT_DESC, $ficheValues);

      $fichesIds = array_column($ficheValues, 'fiche_id');
      $idsOrdered = implode(',', $fichesIds);
      $fiches = Fiche::whereIn('id', $fichesIds)
         ->orderByRaw(DB::raw("FIELD(id, $idsOrdered)"))
         ->skip($count)->take(10)
         ->get();

      return view('utilisateur.fiches.table-fiches-importants', compact('fiches'));
   }


   public function getListeFichePriorite() {
      return view('utilisateur.fiches.fiches-importants');
   }


   //multi search by value & etat fiche
   public function getFichesIds($etatId = null, $datasearch, $alletat = null, $rappel = null) {

      //dd($rappel,'zerzer');
      $user = User::findOrFail(Auth::user()->id);
      $usersIds = $user->getUsersEquipeByUser($user->id);
      foreach($datasearch as $key => $value) {
         if($value == null) {
            $datasearch[$key] = "%%";
         } else {
            $datasearch[$key] = "%" . $value . "%";
         }
      }
      $fiches = DB::table('fiches')
         ->join('fiche_etats', 'fiches.etat_id', '=', 'fiche_etats.id')
         ->join('personnes', 'fiches.personne_id', '=', 'personnes.id')
         ->join('details_personnes', 'fiches.personne_id', '=', 'details_personnes.personne_id');
      if(!$user->isRole('admin')) {
         $fiches->whereIn('fiches.user_id', $usersIds);
      }

      if($alletat == 'false') {
         $fiches->where('fiches.etat_id', '=', $etatId);
         //dd('false');
      } //else{dd('true');}
      //dd($datasearch);
      $fiches->where(function($query) use ($datasearch) {
         $query->orWhere('fiche_etats.valeur', 'like', $datasearch['etat'])
            ->orWhere('personnes.nom', 'like', $datasearch['nom'])
            ->orWhere('personnes.prenom', 'like', $datasearch['prenom'])
            ->orWhere('details_personnes.telephone_1', 'like', $datasearch['telephone'])
            ->orWhere('details_personnes.email', 'like', $datasearch['email'])
            ->orWhere('details_personnes.adresse', 'like', $datasearch['adresse']);
      });
      // dd($fiches->toSql());

      if($rappel != null) {
         switch($rappel) {
            case -1:
               $fiches->whereDate('fiches.date_rappel', '<', \Carbon\Carbon::now());
               break;
            case 0:
               $fiches->whereDate('fiches.date_rappel', '=', \Carbon\Carbon::now());
               break;
            case 1:
               $fiches->whereDate('fiches.date_rappel', '>', \Carbon\Carbon::now());
               break;
         }
      }

      $fiches = $fiches->pluck('fiches.id');
      //dd(sizeof($fiches));
      return $fiches;


      /*$fiches = DB::table('fiches')
      ->join('fiche_etats', 'fiches.etat_id', '=', 'fiche_etats.id')
      ->join('personnes', 'fiches.personne_id', '=', 'personnes.id')
      ->join('details_personnes', 'fiches.personne_id', '=', 'details_personnes.id')
      ->where('fiches.user_id', '=', $user_id)
      ->where('fiche_etats.valeur', 'like', $datasearch['etat'])
      ->orWhere('personnes.nom', 'like', $datasearch['nom'])
      ->orWhere('personnes.prenom', 'like', $datasearch['prenom'])
      ->orWhere('details_personnes.telephone_1', 'like', $datasearch['telephone'])
      ->orWhere('details_personnes.email', 'like', $datasearch['email'])
      ->orWhere('details_personnes.adresse', 'like', $datasearch['adresse'])
      ->pluck('fiches.id');*/

      /*$query = "select P.id as IDPersonne, F.id, FE.valeur as ETAT from fiches F,fiche_etats FE, personnes P, details_personnes DP
                            WHERE FE.id=F.etat_id
                            and F.personne_id=P.id
                            and F.user_id=3
                            and P.id=DP.id

                            and FE.valeur like '%De%'
                            and P.nom like '%De%'
                            and P.prenom like '%De%'
                            and DP.email like '%De%'
                            and DP.adresse like '%De%'
                            ";*/

      /* ->where('fiche_etats.valeur', 'like', $datasearch['etat'])
       ->orWhere('personnes.nom', 'like', $datasearch['nom'])
       ->orWhere('personnes.prenom', 'like', $datasearch['prenom'])
       ->orWhere('details_personnes.telephone_1', 'like', $datasearch['telephone'])
       ->orWhere('details_personnes.email', 'like', $datasearch['email'])
       ->orWhere('details_personnes.adresse', 'like', $datasearch['adresse'])
       */
   }


   public function getBanques(Request $request) {
      $response = '';
      if($request->nom_banque === null) {
         $banques = Banque::All();
      } else {
         $banques = Banque::where('nom', 'like', '%' . $request->nom_banque . '%')
            ->get();
      }
      //dd($banques);
      foreach($banques as $banque) {
         //if($banque->ville->name != null) {
         $response .= '<a  class="pointer banque-name" data-banque-nom ="' . $banque->nom . '" data-banque-adresse ="' . $banque->adresse . '" data-ville-id ="' . $banque->ville_id . '" > - ' . ucfirst($banque->nom) . '</a><br>';
         //}
      }
      return $this->sendResponse($response, '');
   }


   public function getCotRed($FormuleId, $FicheId) {

      $Cot = app('App\Http\Controllers\TarificateurController')->getPrices(null, $FormuleId, $FicheId);
      $Cot = $Cot->getContent();
      $Cot = json_decode($Cot, true);
      return $data = (['Cot' => $Cot['data'], 'Red' => 0]);
   }

   public function getGammes($compagnie_id) {
      $gammes = Gamme::where('compagnie_id', '=', $compagnie_id)->get();
      return $this->sendResponse($gammes, '');
   }

   public function getFormules($gamme_id) {
      $formules = Formule::where('gamme_id', '=', $gamme_id)->get();
      return $this->sendResponse($formules, '');
   }


}
