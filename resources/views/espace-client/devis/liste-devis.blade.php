@extends('layouts.app')
@section('content')
    <!--<script src="{{asset('js/espace-client/mon-profile.js')}}"></script>-->
    @include('includes.breadcrumb.page-header',['home'=>'accueil','page'=>'mes devis','title'=>'Mes devis'])
    <div class="container p-5">
        @if(Session::has('message'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-styled-left rounded-0"
                         id="fiche-alert">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span>
                            <span class="sr-only">Close</span></button>
                        <h4 class="alert-heading">Succès !</h4>
                        <p class="mb-0">
                            {{ Session::get('message') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            @forelse($liste_devis as $devis)
                <div class="col-3 pb-4">
                    <table class="col-md-12" border="0" cellpadding="0" cellspacing="0" align=""
                           bgcolor="#ffffff" style="border: 1px solid slategray; background-color: #ffffff;">
                        <tbody>
                        <tr>
                            <td width="100%" valign="top">
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                    <tbody>
                                    <tr>
                                        <td height="15">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center"
                                            style="text-transform:uppercase !important;font-weight : bold;color: #444444; font-size: 17px; line-height: 26px; padding: 0 5px;">
                                            {{$devis->formule->nom}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="15">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="100" height="1" bgcolor="#e9e9e9"
                                            style="font-size: 1px; line-height: 1px;">
                                            &nbsp;
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="20">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" height="24"
                                            style="color: #444444; font-size: 38px; line-height: 15px; padding: 6px 5px 6px 5px; font-weight: 700;">
                                            <span style="font-size: 18px; position: relative; bottom: 12px;">€ </span>
                                            {{$devis->cotisation}}
                                            <span style="font-size: 14px; color: #808080; font-style: italic;"> / mois</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center"
                                            style="color: #808080; font-size: 14px; line-height: 22px; padding: 2px 5px;">
                                            <img style="width: 100px;height: 100px"
                                                 src="{{asset('images/gammes/'.$devis->formule->gamme->nom)}}.png">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="10">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center"
                                            style="color: #808080; font-size: 14px; line-height: 22px; padding: 2px 5px;">
                                            {{$devis->formule->gamme->compagnie->nom}}
                                            - {{$devis->formule->gamme->nom}}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="10">
                                        </td>
                                    </tr>


                                    <tr>
                                        <td width="auto" align="center">
                                            <table border="0" cellpadding="0" cellspacing="0" align="center">
                                                <tbody>
                                                <tr>
                                                    <td width="auto" align="center" height="38"
                                                        bgcolor="#fa6f6f"
                                                        style="border-radius: 20px; padding-left: 22px; padding-right: 22px; font-weight: 500;">
                                                        <a href="{{url('/espace-client/devis-'.$devis->id)}}"
                                                           style="color: #ffffff; font-size: 12px; text-decoration: none; text-transform: uppercase; line-height: 32px;">
                                                            voir les details
                                                        </a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="30">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            @empty
                <h1 class="offset-2 col-8 p-5 text-center">Vous n'avez pas aucune devis</h1>
            @endforelse
        </div>
    </div>
@endsection