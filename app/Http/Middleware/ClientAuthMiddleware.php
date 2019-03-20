<?php

namespace App\Http\Middleware;

use App\Personne;
use Closure;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class ClientAuthMiddleware {
   /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request $request
    * @param  \Closure $next
    * @return mixed
    */
   public function handle($request, Closure $next) {
      if(!$request->session()->exists('user') || Session::get('user')->type != 'client') {
         Session::flash('message', 'Vous devez d\'abord vous connecter');
         Session::flash('alert-class', 'alert-danger');
         return redirect(Lang::get('routes.connexion'));
      }else{
         $personne = Personne::findOrFail(Session::get('user')->id);
         if($personne->password_updated_at == null){
            Session::flash('message', 'Vous devez modifier votre mot de passe lors de la première connexion');
            Session::flash('alert-class', 'alert-warning');
            return redirect('espace-client/mot-de-pass-modification');
         }
      }
      return $next($request);
   }
}
