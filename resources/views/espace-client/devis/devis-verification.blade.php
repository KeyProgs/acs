@extends('layouts.app')
@section('content')
    <script src="{{asset('js/devis/devis-verification.js')}}"></script>
    <!--include('includes.breadcrumb.page-header',['home'=>'accueil','page'=>'devis verification','title'=>'Devis verification'])-->
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
                            @if(Session::has('data_signature') && Session::get('data_signature')!=null)
                                @include('signature.forme-signature', ['data' =>Session::get('data_signature')])
                            @endif
                        </div>

                @else
                    @php
                        $nombre_enfants = @sizeof($fiche->personne->enfants());
                        $enfants = $fiche->personne->enfants();
                        if(!empty($fiche->personne->conjoint())){
                            $conjoint = \App\Personne::find($fiche->personne->conjoint()->id);
                        }else{
                            $conjoint = null;
                        }
                    @endphp
                    @include('includes.steper.steper',['title'=>'Devis verification'])

                @endif













                <!--<script type="text/javascript">

                            $(window).bind("load", function () {
                                var form = $("#signature_form");
                                $.ajax({
                                    url: form.attr("action"),
                                    type: "POST",
                                    data: form.serialize(),
                                    //cache: false,
                                    success: function (data) {
                                        alert('good');
                                    }
                                });

                            });


                        </script>-->

                </div>
            </div>
    </section>
@endsection