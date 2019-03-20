<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;

// app/routes.php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*
 *  Set up locale and locale_prefix if other language is selected
 */


if(in_array(Request::segment(1), Config::get('app.alt_langs'))) {
   App::setLocale(Request::segment(1));
   Config::set('app.locale_prefix', Request::segment(1));
}


Route::get('/clear', function() {
   Artisan::call('cache:clear');
   Artisan::call('view:clear');
   return '<h1>Cache facade value cleared</h1>
           <br>
           <h1>Cache view cleared</h1>';
});


/*Route::get('/', function() {
   return view('welcome');
});*/


Route::group(['prefix' => Config::get('app.locale_prefix')], function() {


   // =============================== web site routes ============================
   //page d'accueil
   Route::get('/', function() {
      $titre = "Acs Assurance - ";
      $gammes = \App\Gamme::all();
      return view('accueil',compact('titre','gammes'));
   });
   //connexion
   Route::get('/{connexion}', 'ClientController@connexionForm')->where('connexion', Lang::get('routes.connexion'));
   Route::post('/connexion', 'ClientController@connexion');
   //inscription
   Route::get('/{inscription}', 'ClientController@inscriptionForm')->where('inscription', Lang::get('routes.inscription'));
   Route::post('/inscription', 'ClientController@inscription');

   Route::get('/{espace_client}', 'ClientController@espaceClient')->where('espace_client', Lang::get('routes.espace_client'));
   //espace client profile
   Route::get('/{espace_client}/{mon_profile}', 'ClientController@monProfileDetails')
      ->where(['espace_client' => Lang::get('routes.espace_client'), 'mon_profile' => Lang::get('routes.mon_profile')]);
   //espace client modification profile
   Route::post('/profile-modification', 'ClientController@modificationProfile');

   //espace client liste devis
   Route::get('/{espace_client}/{mes_devis}', 'ClientController@listeDevis')
      ->where(['espace_client' => Lang::get('routes.espace_client'), 'mes_devis' => Lang::get('routes.mes_devis')]);
   //espace client devis details
   //Route::get('/new-devis/{id}', 'DevisController@devisInfos');
   Route::get('/{espace_client}/devis-{devis_id}', 'DevisController@devisInfos')
      ->where(['espace_client' => Lang::get('routes.espace_client')]);
   //espace client devis details
   Route::get('/{espace_client}/{user_type}/{token}/f-{fiche_id}/devis-{devis_id}/{formule_id}', 'ClientController@devisVerification')
      ->where(['espace_client' => Lang::get('routes.espace_client')]);
   //page contact
   Route::get('/{contact}/', function() {
      $titre = "Acs Assurance - Nous Contacter";
      $gammes = \App\Gamme::all();
      return view('contact',compact('titre','gammes'));
   })->where('contact', Lang::get('routes.contact'));


   Route::post('/contactez-nous','ClientController@getContactDetails');

   Route::get('/{a_propos}/', function() {
      return "about page " . App::getLocale();
   })->where('a_propos', Lang::get('routes.a_propos'));

   Route::get('/espace-client/mot-de-pass-modification','ClientController@modificationPasswordForm');
   Route::post('/espace-client/mot-de-pass-modification','ClientController@modificationPassword');

   // =============================== /web site routes ============================


   // ============================== dev routes ==================================
   Route::get('/set-session', function() {
      $personne = \App\Personne::find(30593);
      $personne->type = 'client';
      Session::put('user', $personne);

      /*$date = \Carbon\Carbon::parse('2016');
      $now = \Carbon\Carbon::now();
      $diff = $date->diffInYears($now);*/
   });
   Route::get('/get-villes/{code_postal}', 'GlobaleController@getVilles');
   Route::get('/get-liste-banques', 'GlobaleController@getBanques');
   Route::post('/step-validation/{step_id}', 'ClientController@inscriptionValidation');
   Route::get('refresh_captcha', 'ClientController@refreshCaptcha')->name('refresh_captcha');
   // ============================== /dev routes ==================================

   //Route::get('/pdf', 'PdfController@generate_pdf');
   //Route::get('/api/{table}/{field}/{value}', 'PdfJsonController@getTableDataById');
   Route::get('/api/get-pdf-data/f-{fiche_id}/d-{devis}', 'PdfJsonController@getPdfData');
   Route::get('/api/test', 'PdfJsonController@getCotisation');
});