@extends('layouts.app')
@section('content')
    <script src="{{asset('js/espace-client/mon-profile.js')}}"></script>
    @include('includes.breadcrumb.page-header',['home'=>'accueil','page'=>'mon profile','title'=>'Mon profile'])
    <section class="checkout-area form-box">
        <div class="container form">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-10 offset-lg-1 form-wizard">
                @if(Session::has('message'))
                        <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-styled-left rounded-0"
                             id="fiche-alert">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span>
                                <span class="sr-only">Close</span></button>
                            <h4 class="alert-heading">Succès !</h4>
                            <p class="mb-0">
                                {{ Session::get('message') }}
                            </p>
                        </div>
                @endif
                @php
                    $nombre_enfants = @sizeof($fiche->personne->enfants());
                    $enfants = $fiche->personne->enfants();
                    if(!empty($fiche->personne->conjoint())){
                        $conjoint = \App\Personne::find($fiche->personne->conjoint()->id);
                    }else{
                        $conjoint = null;
                    }
                @endphp
                @include('includes.steper.steper')
            </div>
        </div>
    </section>
@endsection