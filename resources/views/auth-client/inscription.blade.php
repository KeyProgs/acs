@extends('layouts.app')
@section('content')
    <script src="{{asset('js/inscription/inscription.js')}}"></script>
    @include('includes.breadcrumb.page-header',['home'=>'accueil','page'=>'inscription','title'=>'Inscription'])
    <section class="checkout-area form-box">
        <div class="container form">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-10 offset-lg-1 form-wizard">
                    <!-- Form Wizard -->
                    <form id="inscription_form">
                        @csrf
                        <h3>Inscription</h3>
                        <p>Remplissez les champs pour passer à l'étape suivante</p>
                        <!-- Form progress -->
                        <div class="form-wizard-steps form-wizard-tolal-steps-4">
                            <div class="form-wizard-progress">
                                <div class="form-wizard-progress-line" data-now-value="12.25" data-number-of-steps="4"
                                     style="width: 12.25%;"></div>
                            </div>
                            <!-- Step 1 -->
                            <div id="form-wizard-step-1" class="form-wizard-step active">
                                <div class="form-wizard-step-icon"><i class="fa fa-briefcase" aria-hidden="true"></i>
                                </div>
                                <p>Vos besoins</p>
                            </div>
                            <!-- Step 1 -->

                            <!-- Step 2 -->
                            <div id="form-wizard-step-2" class="form-wizard-step">
                                <div class="form-wizard-step-icon"><i class="fa fa-user"
                                                                      aria-hidden="true"></i></div>
                                <p>Vos coordonnées</p>
                            </div>
                            <!-- Step 2 -->

                            <!-- Step 3 -->
                            <div id="form-wizard-step-3" class="form-wizard-step">
                                <div class="form-wizard-step-icon"><i class="fa fa-file" aria-hidden="true"></i>
                                </div>
                                <p>Contrat</p>
                            </div>
                            <!-- Step 3 -->

                            <!-- Step 4 -->
                            <div id="form-wizard-step-4" class="form-wizard-step">
                                <div class="form-wizard-step-icon"><i class="fa fa-check-square" aria-hidden="true"></i>
                                </div>
                                <p>Confirmation</p>
                            </div>
                            <!-- Step 4 -->


                        </div>
                        <!-- Form progress -->

                        <!-- Form Step 1 -->
                        <fieldset id="form-step-1">
                            <!-- Personnes à assurer-->
                            <div class="row pb-5 mt-4">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="card rounded-0">
                                        <div class="card-header ">
                                            <div class="title-box pb-0">
                                                <h3>Les personnes à assurer</h3>
                                            </div>
                                        </div>
                                        <div class="card-body ">
                                            <div class="form billing-info">
                                                <div class="row">
                                                    <div class="offset-md-2 col-md-4 field-label">
                                                        Nombre d'adultes
                                                    </div>
                                                    <div class="col-md-8 radio-div">
                                                        <!--<div class="inputGroup">
                                                            <input id="1_adulte" name="nombre_adultes" type="radio"
                                                                   checked/>
                                                            <label for="1_adulte">1 Adulte</label>
                                                        </div>
                                                        <div class="inputGroup">
                                                            <input id="2_adulte" name="nombre_adultes" type="radio"/>
                                                            <label for="2_adulte">2 Adultes</label>
                                                        </div>-->
                                                        <select name="nombre_adultes" id="nombre_adultes"
                                                                class="custom-select form-control rounded-0">
                                                            <option value="1" selected="selected">1 Adulte</option>
                                                            <option value="2">2 Adultes</option>
                                                        </select>
                                                        <strong id="error_nombre_adultes"
                                                                class="font-weight-bold error text-danger"></strong>
                                                    </div>
                                                </div>
                                                <div class="p-2">
                                                </div>
                                                <div class="row">
                                                    <div class="offset-md-2 col-md-4 field-label">
                                                        Nombre d'enfants
                                                    </div>
                                                    <div class="col-md-8 radio-div">
                                                        <!--<div class="inputGroup">
                                                            <input id="radio1" name="nombre_enfants" type="radio" checked/>
                                                            <label for="radio1">Aucun enfant</label>
                                                        </div>

                                                        <div class="inputGroup">
                                                            <input id="enfant_1" name="nombre_enfants" type="radio"
                                                                   checked/>
                                                            <label for="enfant_1">1 enfant</label>
                                                        </div>
                                                        <div class="inputGroup">
                                                            <input id="enfant_2" name="nombre_enfants" type="radio"/>
                                                            <label for="enfant_2">2 enfants</label>
                                                        </div>

                                                        <div class="inputGroup">
                                                            <input id="enfant_3" name="nombre_enfants" type="radio"/>
                                                            <label for="enfant_3">3 enfants</label>
                                                        </div>
                                                        <div class="inputGroup">
                                                            <input id="enfant_4" name="nombre_enfants" type="radio"/>
                                                            <label for="enfant_4">4 enfants</label>
                                                        </div>

                                                        <div class="inputGroup">
                                                            <input id="enfant_5_plus" name="nombre_enfants" type="radio"/>
                                                            <label for="enfant_5_plus">5 enfants ou plus</label>
                                                        </div>-->


                                                        <select class="custom-select form-control rounded-0"
                                                                name="nombre_enfants" id="nombre_enfants">
                                                            <option value="0" selected="selected">
                                                                Aucun enfant
                                                            </option>
                                                            <option value="1">1 enfant</option>
                                                            <option value="2">2 enfants</option>
                                                            <option value="3">3 enfants</option>
                                                            <option value="4">4 enfants</option>
                                                            <option value="5">5 enfants ou plus</option>
                                                        </select>
                                                        <strong id="error_nombre_enfants"
                                                                class="font-weight-bold error text-danger"></strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Personnes à assurer-->

                            <!-- Porspect -->
                            <div class="row pb-5">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="card rounded-0">
                                        <div class="card-header ">
                                            <div class="title-box pb-0">
                                                <h3>Prospect</h3>
                                            </div>
                                        </div>
                                        <div class="card-body ">
                                            <div class="form billing-info">

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="field-label">Civilité*</div>
                                                        <div class="field-input">
                                                            <select name="civilite_prospect"
                                                                    class="custom-select form-control rounded-0">
                                                                @foreach($civilites->sortByDesc('created_at') as $civilite)
                                                                    <option value="{{$civilite->id}}">{{$civilite->libelle}}</option>
                                                                @endforeach
                                                            </select>
                                                            <strong id="error_civilite_prospect"
                                                                    class="font-weight-bold error text-danger"></strong>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="field-label">Date Naissance*</div>
                                                        <div class="field-input">
                                                            <input class="datepicker" type="text"
                                                                   name="date_naissance_prospect"
                                                                   id="date_naissance_prospect"
                                                                   placeholder="JJ/MM/AAAA">
                                                            <strong id="error_date_naissance_prospect"
                                                                    class="font-weight-bold error text-danger"></strong>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="field-label">Régime *</div>
                                                        <div class="field-input">
                                                            <select name="regime_prospect"
                                                                    class="custom-select form-control rounded-0">
                                                                @foreach($regimes as $regime)
                                                                    <option value="{{$regime->id}}">{{$regime->libelle}}</option>
                                                                @endforeach
                                                            </select>
                                                            <strong id="error_regime_prospect"
                                                                    class="font-weight-bold error text-danger"></strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Porspect -->

                            <!-- Conjoint -->
                            <div id="conjoint_section" style="display: none" class="row pb-5">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="card rounded-0">
                                        <div class="card-header ">
                                            <div class="title-box pb-0">
                                                <h3>Conjoint</h3>
                                            </div>
                                        </div>
                                        <div class="card-body ">
                                            <div class="form billing-info">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="field-label">Civilité*</div>
                                                        <div class="field-input">
                                                            <select name="civilite_conjoint"
                                                                    class="custom-select form-control rounded-0">
                                                                @foreach($civilites as $civilite)
                                                                    <option value="{{$civilite->id}}">{{$civilite->libelle}}</option>
                                                                @endforeach
                                                            </select>
                                                            <strong id="error_civilite_conjoint"
                                                                    class="font-weight-bold error text-danger"></strong>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="field-label">Date Naissance*</div>
                                                        <div class="field-input">
                                                            <input class="datepicker" type="text"
                                                                   name="date_naissance_conjoint"
                                                                   placeholder="JJ/MM/AAAA">
                                                            <strong id="error_date_naissance_conjoint"
                                                                    class="font-weight-bold error text-danger"></strong>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="field-label">Régime *</div>
                                                        <div class="field-input">
                                                            <select name="regime_conjoint"
                                                                    class="custom-select form-control rounded-0">
                                                                @foreach($regimes as $regime)
                                                                    <option value="{{$regime->id}}">{{$regime->libelle}}</option>
                                                                @endforeach
                                                            </select>
                                                            <strong id="error_regime_conjoint"
                                                                    class="font-weight-bold error text-danger"></strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Conjoint -->

                            <!-- Enfants-->
                            <div id="enfants_section" style="display: none" class="row pb-5">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="card rounded-0">
                                        <div class="card-header ">
                                            <div class="title-box pb-0">
                                                <h3>Enfants</h3>
                                            </div>
                                        </div>
                                        <div class="card-body ">
                                            <div class="form billing-info">
                                                @for($i = 1;$i<6;$i++)
                                                    <div class="row enfant" id="enfant_{{$i}}">
                                                        <div class="offset-md-1 col-md-2">
                                                            <div class="field-label mt-4">
                                                                Enfant {{$i}}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="field-label">
                                                                Date Naissance
                                                            </div>
                                                            <div class="field-input">
                                                                <input type="text" class="datepicker"
                                                                       name="date_naissance_enfant_{{$i}}">
                                                                <strong id="error_date_naissance_enfant_{{$i}}"
                                                                        class="font-weight-bold error text-danger"></strong>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="field-label">
                                                                Régime
                                                            </div>
                                                            <div class="field-input">
                                                                <select name="regime_enfant_{{$i}}"
                                                                        class="custom-select form-control rounded-0">
                                                                    @foreach($regimes as $regime)
                                                                        <option value="{{$regime->id}}">{{$regime->libelle}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <strong id="error_regime_enfant_{{$i}}"
                                                                        class="font-weight-bold error text-danger"></strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Enfants-->
                            <br>


                            <div class="form-wizard-buttons">
                                <button type="button" data-index="1" class="btn btn-primary btn-next rounded-0">
                                    Suivant
                                </button>
                            </div>

                        </fieldset>
                        <!-- Form Step 1 -->

                        <!-- Form Step 2 -->
                        <fieldset id="form-step-2" style="display: none">
                            <!-- Vos coordonnées -->
                            <div class="row mt-4">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="card rounded-0">
                                        <div class="card-header ">
                                            <div class="title-box pb-0">
                                                <h3>Vos coordonnées</h3>
                                            </div>
                                        </div>
                                        <div class="card-body ">
                                            <div class="form billing-info">
                                                <div class="row pb-3">
                                                    <div class="col-md-6">
                                                        <div class="field-label">Nom*</div>
                                                        <div class="field-input">
                                                            <input type="text" name="nom" id="nom">
                                                            <strong id="error_nom"
                                                                    class="font-weight-bold error text-danger"></strong>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="field-label">Prénom*</div>
                                                        <div class="field-input">
                                                            <input type="text" name="prenom" id="prenom">
                                                            <strong id="error_prenom"
                                                                    class="font-weight-bold error text-danger"></strong>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row pb-3">
                                                    <div class="col-md-6">
                                                        <div class="field-label">Email*</div>
                                                        <div class="field-input">
                                                            <input type="text" name="email" id="email">
                                                            <strong id="error_email"
                                                                    class="font-weight-bold error text-danger"></strong>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="field-label">Téléphone*</div>
                                                        <div class="field-input">
                                                            <input type="text" name="telephone" id="telephone">
                                                            <strong id="error_telephone"
                                                                    class="font-weight-bold error text-danger"></strong>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row pb-3">
                                                    <div class="col-md-2">
                                                        <div class="field-label">Code postal*</div>
                                                        <div class="field-input">
                                                            <input type="text" name="code_postal" id="code_postal">
                                                            <strong id="error_code_postal"
                                                                    class="font-weight-bold error text-danger"></strong>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="field-label">Ville</div>
                                                        <div class="field-input">
                                                            <select name="ville" id="ville"
                                                                    class="custom-select form-control rounded-0">
                                                            </select>
                                                            <!--<input type="text" name="ville" id="ville">
                                                            <div id="code_postal_proposition" class="dropdown-proposition">
                                                            </div>-->
                                                            <strong id="error_ville"
                                                                    class="font-weight-bold error text-danger"></strong>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="field-label">Adresse</div>
                                                        <div class="field-input">
                                                            <textarea name="adresse" id="adresse"></textarea>
                                                            <strong id="error_adresse"
                                                                    class="font-weight-bold error text-danger"></strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Vos coordonnées -->
                            <br>
                            <div class="form-wizard-buttons">
                                <button type="button" data-index="2" class="btn btn-info rounded-0 btn-previous">
                                    Retour
                                </button>
                                <button type="button" data-index="2" class="btn btn-primary rounded-0 btn-next">
                                    Suivant
                                </button>
                            </div>
                        </fieldset>
                        <!-- Form Step 2 -->

                        <!-- Form Step 3 -->
                        <fieldset id="form-step-3" style="display: none">
                            <!-- Contrat infos -->
                            <div class="row mt-4">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="card rounded-0">
                                        <div class="card-header ">
                                            <div class="title-box pb-0">
                                                <h3>Votre contrat</h3>
                                            </div>
                                        </div>
                                        <div class="card-body ">
                                            <div class="form billing-info">
                                                <div class="row pb-3">
                                                    <div class="col-md-6">
                                                        <div class="field-label">Date de début de contrat souhaitée *
                                                        </div>
                                                        <div class="field-input">
                                                            <input type="text" name="date_effet" id="date_effet"
                                                                   class="datepicker-f">
                                                            <strong id="error_date_effet"
                                                                    class="font-weight-bold error text-danger"></strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Contrat infos -->
                            <br/>
                            <div class="form-wizard-buttons">
                                <button type="button" data-index="3" class="btn btn-info rounded-0 btn-previous">
                                    Retour
                                </button>
                                <button type="button" data-index="3" class="btn btn-primary rounded-0 btn-next">
                                    Suivant
                                </button>
                            </div>
                        </fieldset>
                        <!-- Form Step 3 -->

                        <!-- Form Step 4 -->
                        <fieldset id="form-step-4" style="display: none">
                            <br/>
                            <div class="form-wizard-buttons">
                                <button type="button" data-index="4" class="btn btn-info rounded-0 btn-previous">
                                    Retour
                                </button>
                                <button type="button" data-index="4"
                                        class="btn btn-success rounded-0 btn-submit-inscription">
                                    Enregistrer
                                </button>
                            </div>
                        </fieldset>
                        <!-- Form Step 4 -->
                    </form>
                    <!-- Form Wizard -->
                </div>
            </div>
        </div>
    </section>

@endsection
