@extends('layouts.app')
@section('content')
    @include('includes.breadcrumb.page-header',['home'=>'accueil','page'=>'','title'=>'Page d\'accueil'])



    <!--Start contact form area-->
    <section class="contact-info-area">
        <div class="container">
            <div class="row">

                <div class="col-xl-7 col-lg-6 col-md-12 col-sm-12">
                    <div class="contact-box-content">
                        <div class="img-holder">
                            <img src="{{asset('images/resources/contact.jpg')}}" title="Acs assurance"
                                 alt="Acs assurance">
                        </div>
                        <div class="text-holder">
                            <div class="row">

                                <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12">
                                    <div class="opening-hours text-center">
                                        <div class="title-box center text-center">
                                            <h3>Heures d'ouverture</h3>
                                        </div>
                                        <div class="inner-content">
                                            <h3>Lundi - Samedi </h3>
                                            <h1>09.00 <span>a </span> 18.00</h1>
                                            <h3>Dimanche fermé</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12">
                                    <div class="quick-contact-box">
                                        <div class="title-box">
                                            <h3>Contact rapide</h3>
                                        </div>
                                        <ul>
                                            <li>
                                                <div class="icon-holder">
                                                    <span class="flaticon-phone"></span>
                                                </div>
                                                <div class="title-holder">
                                                    <p>04-48-30-00-83</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="icon-holder">
                                                    <span class="flaticon-mail"></span>
                                                </div>
                                                <div class="title-holder">
                                                    <p>contact@acsassurance.com</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="icon-holder">
                                                    <span class="flaticon-global"></span>
                                                </div>
                                                <div class="title-holder">
                                                    <p>22 Rue de Dunkerque, 11400 Castelnaudary,<br> France.</p>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="map-find">
                                            <a class="btn-two" title="nous trouvez sur la carte" href="#">Nous trouvez
                                                sur la carte<span class="flaticon-next"></span></a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12">
                    <div class="contact-form">
                        <div class="sec-title">
                            <div class="inner clr2"><span class="clr2">Comment pouvons nous vous aider</span></div>
                            <div class="title clr2">Envoyez votre message</div>
                        </div>
                        <form id="contact-form" name="contact_form" class="default-form" action="inc/sendmail.php"
                              method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-box">
                                        <input type="text" name="form_name" value="" placeholder="Votre nom*"
                                               required="">
                                    </div>
                                    <div class="input-box">
                                        <input type="email" name="form_email" value="" placeholder="Votre Email*"
                                               required="">
                                    </div>
                                    <div class="input-box">
                                        <input type="text" name="form_phone" value="" placeholder="Téléphone">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-box">
                                        <select class="selectmenu">
                                            <option selected="selected">pour quoi nous contacter</option>
                                            <option>Service Generale</option>
                                            <option>Recouvrement</option>
                                            <option>Information</option>
                                            <option>Souscription</option>
                                            <option>Info Medecins</option>
                                            <option>Rembourcement</option>
                                            <option>Tier Payant</option>
                                        </select>
                                    </div>
                                    <div class="input-box">
                                        <textarea name="form_message" placeholder="Votre Message.."
                                                  required=""></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input id="form_botcheck" name="form_botcheck" class="form-control" type="hidden"
                                           value="">
                                    <button class="btn-two thm-bg-clr" type="submit"
                                            data-loading-text="Merci de patienter...">Envoyer <span
                                                class="flaticon-next"></span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--End contact form area-->

    <!--Start location map area-->
    <section class="location-map-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-12 col-sm-12">
                    <div class="location-box">
                        <div class="title">
                            <h3> Nous trouver</h3>
                        </div>
                        <div id="scrollbar1">
                            <div class="scrollbar">
                                <div class="track">
                                    <div class="thumb">
                                        <div class="end"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-box viewport">
                                <div class="overview">
                                    <!--Start single accordion box-->
                                    <div class="accordion accordion-block">
                                        <div class="accord-btn active"><h4>France</h4></div>
                                        <div class="accord-content collapsed">
                                            <div class="single-box">
                                                <h3>Castelnaudary</h3>
                                                <ul>
                                                    <li>
                                                        <div class="icon-holder">
                                                            <span class="flaticon-phone"></span>
                                                        </div>
                                                        <div class="title-holder">
                                                            <p>+0 625-07520-6644 </p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="icon-holder">
                                                            <span class="flaticon-mail"></span>
                                                        </div>
                                                        <div class="title-holder">
                                                            <p>contact@acsassurance.com</p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="icon-holder">
                                                            <span class="flaticon-global"></span>
                                                        </div>
                                                        <div class="title-holder">
                                                            <p>22 Rue de Dunkerque, Castelnaudary,<br> France 11400.</p>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <div class="map-find">
                                                    <a class="btn-two" title="nous trouver sur la carte" href="#">Nous
                                                        trouver sur la carte<span class="flaticon-next"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End single accordion box-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--<div class="col-xl-8 col-lg-7 col-md-12 col-sm-12">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2867.3798780131197!2d5.046072215360303!3d44.054863834382566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12b58a1b406bffff%3A0xc99827b968a688dd!2zQXNzdXJhbmNlIGNvdXJ0YWdlIHPDqXLDqW5pdMOp!5e0!3m2!1sfr!2sma!4v1543932300746" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>-->
            </div>
        </div>
    </section>
    <!--End location map area-->

    <!--Start working section-->
    <section class="working-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="appointment-right-style2 text-center">
                        <div class="title">
                            <h2>Comparer votre mutuelle</h2>
                            <h1>100% gratuit </h1>
                        </div>
                        <div class="since-working">
                            <h3>liste mutuelles</h3>
                        </div>
                        <div class="button">
                            <a class="btn-two white-bg" title="un rappel !" href="#">Un Rappel<span
                                        class="flaticon-next"></span></a>
                            <a class="btn-two" title="un devis !" href="#">Un Devis<span
                                        class="flaticon-next"></span></a>
                        </div>
                    </div>
                </div>
            </div>
            @include('includes.gammes')
        </div>
    </section>
    <!--End working section-->
@endsection