<?php

namespace App\Providers;

use App\Type_assurance;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\View\View;

class AuthServiceProvider extends ServiceProvider {
   /**
    * The policy mappings for the application.
    *
    * @var array
    */
   protected $policies = [
      'App\Model' => 'App\Policies\ModelPolicy',
   ];

   /**
    * Register any authentication / authorization services.
    *
    * @return void
    */
   public function boot() {
      $types_assurance = Type_assurance::all();
      view()->share('types_assurance', $types_assurance);
      $this->registerPolicies();

      //
   }
}
