<!-- Form Wizard -->
<form id="inscription_form" action="{{url('profile-modification')}}" method="post">
    @csrf
    <input type="hidden" name="fiche_id" value="{{$fiche->id}}">
    <input type="hidden" name="personne_id" value="{{$fiche->personne->id}}">

    @if(!empty($title))
        <h3>{{$title}}</h3>
    @else
        <h3>Mon Profile</h3>
    @endif
    <p>Vous pouvez modifier ces informations</p>
    <!-- Form progress -->
    <div class="form-wizard-steps form-wizard-tolal-steps-4">
        <div class="form-wizard-progress">
            <div class="form-wizard-progress-line" data-now-value="12.25" data-number-of-steps="4"
                 style="width: 12.25%;">
            </div>
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
                                        <option value="1">1 Adulte</option>
                                        <option value="2" @if($conjoint) selected @endif>2 Adultes
                                        </option>
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
                                        <option @if($nombre_enfants=='1') selected @endif value="1">
                                            1
                                            enfant
                                        </option>
                                        <option @if($nombre_enfants=='2') selected @endif value="2">
                                            2 enfants
                                        </option>
                                        <option @if($nombre_enfants=='3') selected @endif value="3">
                                            3 enfants
                                        </option>
                                        <option @if($nombre_enfants=='4') selected @endif value="4">
                                            4 enfants
                                        </option>
                                        <option @if($nombre_enfants=='5') selected @endif value="5">
                                            5 enfants ou plus
                                        </option>
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
                                                <option @if($fiche->personne->civilite_id==$civilite->id) selected
                                                        @endif value="{{$civilite->id}}">{{$civilite->libelle}}</option>
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
                                               placeholder="JJ/MM/AAAA"
                                               value="{{\App\Helpers\Helper::getDateFormat($fiche->personne->date_naissance)}}"
                                        >
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
                                                <option @if($fiche->personne->regime_id == $regime->id) selected
                                                        @endif value="{{$regime->id}}">{{$regime->libelle}}</option>
                                            @endforeach
                                        </select>
                                        <strong id="error_regime_prospect"
                                                class="font-weight-bold error text-danger"></strong>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="field-label">Numéro de sécurité sociale</div>
                                    <div class="field-input">
                                        <input type="text" name="numero_securite_sociale" placeholder=""
                                               value="{{$fiche->personne->numero_securite_sociale}}">
                                        <strong id="error_numero_securite_sociale"
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
        <div id="conjoint_section" @if(!$conjoint) style="display: none" @endif class="row pb-5">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card rounded-0">
                    <div class="card-header">
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
                                                @if(!$conjoint)
                                                    <option value="{{$civilite->id}}">{{$civilite->libelle}}</option>
                                                @else
                                                    <option @if($conjoint->civilite_id==$civilite->id) selected
                                                            @endif value="{{$civilite->id}}">{{$civilite->libelle}}</option>
                                                @endif
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
                                               placeholder="JJ/MM/AAAA"
                                               @if($conjoint)
                                               value="{{\App\Helpers\Helper::getDateFormat($conjoint->date_naissance)}}"
                                                @endif
                                        >
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
                                                @if(!$conjoint)
                                                    <option value="{{$regime->id}}">{{$regime->libelle}}</option>
                                                @else
                                                    <option @if($conjoint->regime_id == $regime->id) selected
                                                            @endif value="{{$regime->id}}">{{$regime->libelle}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <strong id="error_regime_conjoint"
                                                class="font-weight-bold error text-danger"></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="field-label">Numéro de sécurité sociale</div>
                                    <div class="field-input">
                                        <input type="text" name="numero_securite_sociale_conjoint"
                                               @if($conjoint)
                                               value="{{$conjoint->numero_securite_sociale}}"
                                                @endif>
                                        <strong id="error_numero_securite_sociale_conjoint"
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
        <div id="enfants_section" @if($nombre_enfants == '0') style="display: none"
             @endif  class="row pb-5">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="card rounded-0">
                    <div class="card-header ">
                        <div class="title-box pb-0">
                            <h3>Enfants</h3>
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="form billing-info">
                            @for($i = 1;$i<=$nombre_enfants;$i++)
                                <div class="row enfant"
                                     id="enfant_{{$i}}">
                                    <input type="hidden" class="datepicker"
                                           name="id_enfant_{{$i}}"
                                           value="{{$enfants[$i-1]->id}}">
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
                                                   name="date_naissance_enfant_{{$i}}"
                                                   value="{{\App\Helpers\Helper::getDateFormat($enfants[$i-1]->date_naissance)}}">

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
                                                    <option @if($enfants[$i-1]->regime_id==$regime->id) selected
                                                            @endif value="{{$regime->id}}">{{$regime->libelle}}</option>
                                                @endforeach
                                            </select>
                                            <strong id="error_regime_enfant_{{$i}}"
                                                    class="font-weight-bold error text-danger"></strong>
                                        </div>
                                    </div>


                                </div>
                            @endfor
                            @for($i = $nombre_enfants+1;$i<=5;$i++)
                                <div class="row enfant" style="display: none"
                                     id="enfant_{{$i}}">
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
                                        <input type="text" name="nom" id="nom"
                                               value="{{$fiche->personne->nom}}">
                                        <strong id="error_nom"
                                                class="font-weight-bold error text-danger"></strong>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="field-label">Prénom*</div>
                                    <div class="field-input">
                                        <input type="text" name="prenom" id="prenom"
                                               value="{{$fiche->personne->prenom}}">
                                        <strong id="error_prenom"
                                                class="font-weight-bold error text-danger"></strong>
                                    </div>
                                </div>
                            </div>

                            <div class="row pb-3">
                                <div class="col-md-6">
                                    <div class="field-label">Email*</div>
                                    <div class="field-input">
                                        <input type="text" name="email" id="email"
                                               value="{{$fiche->personne->details->email}}">
                                        <strong id="error_email"
                                                class="font-weight-bold error text-danger"></strong>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="field-label">Téléphone*</div>
                                    <div class="field-input">
                                        <input type="text" name="telephone" id="telephone"
                                               value="{{$fiche->personne->details->telephone_1}}">
                                        <strong id="error_telephone"
                                                class="font-weight-bold error text-danger"></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-2">
                                    <div class="field-label">Code postal*</div>
                                    <div class="field-input">
                                        <input type="text" name="code_postal" id="code_postal"
                                               value="{{$fiche->personne->details->code_postal}}">
                                        <strong id="error_code_postal"
                                                class="font-weight-bold error text-danger"></strong>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="field-label">Ville</div>
                                    <div class="field-input">
                                        <select name="ville" id="ville"
                                                class="custom-select form-control rounded-0">

                                            @if($fiche->personne->details->laville != null)
                                                <option value="{{$fiche->personne->details->laville->id}}">{{$fiche->personne->details->laville->name}}</option>
                                            @endif
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
                                                            <textarea name="adresse"
                                                                      id="adresse">{{$fiche->personne->details->adresse}}</textarea>
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
    <fieldset id="form-step-3" style="display: none ">
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
                                               class="datepicker-f"
                                               value="{{\App\Helpers\Helper::getDateFormat($fiche->date_effet)}}">
                                        <strong id="error_date_effet"
                                                class="font-weight-bold error text-danger"></strong>
                                    </div>
                                </div>
                                @if(!empty($devis))
                                    <div class="col-md-6">
                                        <div class="field-label">Date de prélèvement *</div>
                                        <div class="field-input">
                                            <select name="date_prelevement" id="date_prelevement"
                                                    class="custom-select form-control rounded-0">
                                                <option value=""></option>
                                                <option @if($devis->date_prelevement=="1") selected @endif value="1">1
                                                </option>
                                                <option @if($devis->date_prelevement=="5") selected @endif value="5">5
                                                </option>
                                                <option @if($devis->date_prelevement=="10") selected @endif value="10">
                                                    10
                                                </option>
                                            </select>
                                            <strong id="error_date_prelevement"
                                                    class="font-weight-bold error text-danger"></strong>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @if(!empty($devis))
                                <input type="hidden" value="{{$devis->id}}" name="devis_id">
                                @if($compte)
                                    <input type="hidden" value="{{$compte->id}}" name="compte_id">
                                @endif
                                <div class="title-box ml-4 mt-4">
                                    <h3 style="background-color: #cccccc;width: fit-content;">Titulaire de compte de
                                        paiement
                                    </h3>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="field-label">Nom *
                                        </div>
                                        <div class="field-input">
                                            <input type="text" name="nom_titulaire_compte" id="nom_titulaire_compte"
                                                   @if($compte)
                                                   value="{{$compte->nom}}"
                                                    @endif>
                                            <strong id="error_nom_titulaire_compte"
                                                    class="font-weight-bold error text-danger"></strong>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="field-label">Prenom *</div>
                                        <div class="field-input">
                                            <input type="text" name="prenom_titulaire_compte"
                                                   id="prenom_titulaire_compte"
                                                   @if($compte)
                                                   value="{{$compte->prenom}}"
                                                    @endif>
                                            <strong id="error_prenom_titulaire_compte"
                                                    class="font-weight-bold error text-danger"></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pb-3">
                                    <div class="col-md-2">
                                        <div class="field-label">Code postale *
                                        </div>
                                        <div class="field-input">
                                            <input type="text" name="code_postale_titulaire_compte"
                                                   id="code_postale_titulaire_compte"
                                                   @if($compte->ville_tt)
                                                    value="{{$compte->ville_tt->zip_code}}"
                                                   @endif>
                                            <strong id="error_code_postale_titulaire_compte"
                                                    class="font-weight-bold error text-danger"></strong>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="field-label">Ville *</div>
                                        <div class="field-input">
                                            <select name="ville_titulaire_compte" id="ville_titulaire_compte"
                                                    class="custom-select form-control rounded-0">
                                                @if($compte->ville_tt)
                                                    <option value="{{$compte->ville_tt->id}}">{{$compte->ville_tt->name}}</option>
                                                @endif>
                                            </select>
                                            <strong id="error_ville_titulaire_compte"
                                                    class="font-weight-bold error text-danger"></strong>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="field-label">Adresse *</div>
                                        <div class="field-input">
                                            <input type="text" name="adresse_titulaire_compte"
                                                   id="adresse_titulaire_compte"
                                                   @if($compte)
                                                   value="{{$compte->adresse_tt}}"
                                                    @endif>
                                            <strong id="error_adresse_titulaire_compte"
                                                    class="font-weight-bold error text-danger"></strong>
                                        </div>
                                    </div>
                                </div>


                                <div class="title-box ml-4 mt-4">
                                    <h3 style="background-color: #cccccc;width: fit-content;">Banque</h3>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="field-label"> Nom Banque *</div>
                                        <div class="field-input">
                                            <input type="text" name="banque_nom" id="banque_nom"
                                                   @if($compte)
                                                   value="{{$compte->banque->nom}}"
                                                    @endif>
                                            <div class="bg-grey-custom" id="banque-live-search-nom"></div>
                                            <strong id="error_banque_nom"
                                                    class="font-weight-bold error text-danger"></strong>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="field-label"> BIC *</div>
                                        <div class="field-input">
                                            <input type="text" name="bic" id="bic"
                                                   @if($compte)
                                                   value="{{$compte->bic}}"
                                                    @endif>
                                            <strong id="error_bic" class="font-weight-bold error text-danger"></strong>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="field-label"> IBAN *</div>
                                        <div class="field-input">
                                            <input type="text" name="iban" id="iban"
                                                   @if($compte)
                                                   value="{{$compte->iban}}"
                                                    @endif>
                                            <strong id="error_iban" class="font-weight-bold error text-danger"></strong>
                                        </div>
                                    </div>

                                </div>
                                <div class="row pb-3">

                                    <div class="col-md-2">
                                        <div class="field-label">Code postel *</div>
                                        <div class="field-input">
                                            <input type="text" name="banque_code_postal" id="banque_code_postal"
                                                   @if($compte->ville)
                                                   value="{{$compte->ville->zip_code}}"
                                                    @endif>
                                            <strong id="error_banque_code_postal"
                                                    class="font-weight-bold error text-danger"></strong>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="field-label">Ville *</div>
                                        <div class="field-input">
                                            <select name="banque_ville" id="banque_ville"
                                                    class="custom-select form-control rounded-0">
                                                @if($compte->ville)
                                                    <option value="{{$compte->ville->id}}">{{$compte->ville->name}}</option>
                                                @endif>
                                            </select>
                                            <strong id="error_banque_ville"
                                                    class="font-weight-bold error text-danger"></strong>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="field-label">Adresse *</div>
                                        <div class="field-input">
                                            <input type="text" name="banque_adresse" id="banque_adresse"
                                                   @if($compte)
                                                   value="{{$compte->adresse}}"
                                                    @endif>
                                            <strong id="error_banque_adresse"
                                                    class="font-weight-bold error text-danger"></strong>
                                        </div>
                                    </div>
                                </div>
                            @endif
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
            <button type="submit" data-index="4"
                    class="btn btn-success rounded-0 btn-update-profile-infos">
                Enregistrer
            </button>
        </div>
    </fieldset>
    <!-- Form Step 4 -->

</form>
<!-- Form Wizard -->