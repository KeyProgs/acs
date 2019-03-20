@extends('layouts.app')
@section('content')
    @include('includes.breadcrumb.page-header',['home'=>'accueil','page'=>'inscription','title'=>'Inscription'])
    <section class="checkout-area form-box">
        <div class="container form">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-10 offset-lg-1 form-wizard">
                    @if(Session::has('message'))
                        <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-styled-left rounded-0" id="fiche-alert">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span>
                                <span class="sr-only">Close</span></button>
                            <h4 class="alert-heading">Succès !</h4>
                            <p class="mb-0">
                                {{ Session::get('message') }}
                            </p>
                        </div>
                    @endif
                    <h1 class="p-5">Bienvenue sur votre espace client Acs Assurance</h1>
                </div>
            </div>
        </div>
    </section>
@endsection