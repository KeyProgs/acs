@php
    extract($data);
@endphp

<table style="font-family: 'Calibri Light'" width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tbody>
    <tr>
        <td>
            <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center">
                <tbody>
                <tr>
                    <td align="center">
                        <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center">
                            <tbody>
                            <tr>
                                <td width="100%" height="15"></td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <!-- Nav -->
                                    <table width="90%" border="0" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <td width="100%" valign="middle">


                                                  <!-- Logo -->
                                                <table width="280" border="0" cellpadding="0" cellspacing="0"
                                                       align="left">
                                                    <tbody>
                                                    <tr>
                                                        <td height="60" valign="middle" width="100%" align="left">
                                                            <a href="#"><img width="125"
                                                                             src="{{asset('/images/logos/logo_light.png')}}"
                                                                             alt=""></a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <!-- /logo -->


                                                <!-- View Online -->
                                                <table width="280" border="0" cellpadding="0" cellspacing="0"
                                                       align="right">
                                                    <tbody>
                                                    <tr>
                                                        <td width="99%" align="center">
                                                            <a href="" style="border-radius: 4px;background-color:#4f97e2;color: #ffffff; font-size: 18px; text-decoration: none;padding:6 22 6 22">
                                                                09.72.58.25.76
                                                            </a>
                                                        </td>
                                                        <td height="60" valign="middle" width="1%" align="right">
                                                            <!--<a href="#" style="color: #ffffff;">Check the online
                                                            </a>
                                                            <a href="#" class="btn bg-indigo-300 legitRipple"><i
                                                                        class=" icon-phone position-left"></i>
                                                            </a>-->
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <!-- /view Online -->

                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="100%" height="30"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!-- /nav -->


                                    <!-- Title -->
                                    <table style="border:1px solid slategray;" width="60%" border="0" cellpadding="0"
                                           cellspacing="0" align="left">
                                        <tbody>
                                        <tr>
                                            <td valign="middle" align="center">

                                                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%">
                                                    <tr>
                                                        <th colspan="2"
                                                            style="width:50%;font-weight: bold;background-color: whitesmoke;padding: 6px;color: darkslategrey;border-bottom:1px solid slategray;">
                                                            Client
                                                        </th>
                                                        <th colspan="2"
                                                            style="width:50%;font-weight: bold;background-color: whitesmoke;padding: 6px;color: darkslategrey;border-bottom: 1px solid slategray;">
                                                            Conjoint
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:25%;font-weight: bold;background-color: whitesmoke;padding: 6px;color: darkslategrey;">
                                                            Nom :
                                                        </td>
                                                        <td style="width:25%;font-weight: bold;background-color: whitesmoke;padding: 6px;color: darkslategrey;">
                                                            {{$prospect->nom}} {{$prospect->prenom}}
                                                        </td>
                                                        <td style="width:25%;font-weight: bold;background-color: whitesmoke;padding: 6px;color: darkslategrey;">
                                                            Nom :
                                                        </td>
                                                        <td style="width:50%;font-weight: bold;background-color: whitesmoke;padding: 6px;color: darkslategrey;">
                                                            {{@$conjoint->nom}} {{@$conjoint->prenom}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:25%;font-weight: bold;background-color: whitesmoke;padding: 6px;color: darkslategrey;">
                                                            Régime :
                                                        </td>
                                                        <td style="width:25%;font-weight: bold;background-color: whitesmoke;padding: 6px;color: darkslategrey;">
                                                            {{$prospect->regime->libelle}}
                                                        </td>
                                                        <td style="width:25%;font-weight: bold;background-color: whitesmoke;padding: 6px;color: darkslategrey;">
                                                            Régime :
                                                        </td>
                                                        <td style="width:25%;font-weight: bold;background-color: whitesmoke;padding: 6px;color: darkslategrey;">
                                                            {{$conjoint!=null ?$conjoint->regime->libelle:''}}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td style="width:25%;font-weight: bold;background-color: whitesmoke;padding: 6px;color: darkslategrey;">
                                                            Email :
                                                        </td>
                                                        <td style="width:25%;font-weight: bold;background-color: whitesmoke;padding: 6px;color: darkslategrey;">
                                                            {{$prospect->email}}
                                                        </td>
                                                        <td style="width:25%;font-weight: bold;background-color: whitesmoke;padding: 6px;color: darkslategrey;">
                                                        </td>
                                                        <td style="width:25%;font-weight: bold;background-color: whitesmoke;padding: 6px;color: darkslategrey;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:25%;font-weight: bold;background-color: whitesmoke;padding: 6px;color: darkslategrey;">
                                                            Nombre d'enfants à charge

                                                        </td>
                                                        <td style="width:25%;font-weight: bold;background-color: whitesmoke;padding: 6px;color: darkslategrey;">
                                                            : {{@sizeof($prospect->enfants())}}

                                                        </td>
                                                        <td style="width:25%;font-weight: bold;background-color: whitesmoke;padding: 6px;color: darkslategrey;">

                                                        </td>
                                                        <td style="width:25%;font-weight: bold;background-color: whitesmoke;padding: 6px;color: darkslategrey;">

                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!-- /title -->

                                    <!-- Subtitle -->

                                    <table width="25%" border="0" cellpadding="0" cellspacing="0" align="right"
                                           bgcolor="#ffffff"
                                           style="border: 1px solid slategray; background-color: #ffffff;">
                                        <tbody>
                                        <tr>
                                            <td width="100%" valign="top">
                                                <table width="100%" border="0" cellpadding="0"
                                                       cellspacing="0" align="center">
                                                    <tbody>
                                                    <tr>
                                                        <td height="15">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center"
                                                            style="text-transform:uppercase !important;font-weight : bold;color: #444444; font-size: 17px; line-height: 26px; padding: 0 5px;">
                                                            {{$formule->nom}}
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
                                                            <span style="font-size: 18px; position: relative; bottom: 12px;">€ </span> {{$prix}}
                                                            <span style="font-size: 14px; color: #808080; font-style: italic;"> / mois</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center"
                                                            style="color: #808080; font-size: 14px; line-height: 22px; padding: 2px 5px;">
                                                            <img style="width: 120px;height: 100px"
                                                                 src="{{asset('images/gammes/'.$gamme->nom.'.png')}}"/>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="10">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center"
                                                            style="color: #808080; font-size: 14px; line-height: 22px; padding: 2px 5px;">
                                                            {{$compagnie->nom}} - {{$gamme->nom}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="10">
                                                        </td>
                                                    </tr>


                                                    <tr>
                                                        <td width="auto" align="center">
                                                            <table border="0" cellpadding="0"
                                                                   cellspacing="0" align="center">
                                                                <tbody>
                                                                <tr>
                                                                    <td width="auto" align="center"
                                                                        height="38" bgcolor="#fa6f6f"
                                                                        style="border-radius: 20px; padding-left: 22px; padding-right: 22px; font-weight: 500;">
                                                                        <a href="{{\App\Helpers\Helper::url(Lang::get('routes.espace_client').'/c/'.md5($prospect->id ).'/f-'.$fiche->id.'/devis-'.$devis->id.'/'.$formule->id)}}" style="color: #ffffff; font-size: 12px; text-decoration: none; text-transform: uppercase; line-height: 32px;">Souscrire</a>
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

                                    <!-- /subtitle -->

                                    <!-- Button -->
                                    <table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
                                        <tbody>
                                        <tr>
                                            <td height="40"></td>
                                        </tr>
                                        <!--<tr>
                                            <td width="auto" align="center">
                                                <table border="0" cellpadding="0" cellspacing="0" align="center">
                                                    <tbody>
                                                    <tr>
                                                        <td width="auto" align="center" height="40"
                                                            bgcolor="#344b61"
                                                            style="border-radius: 20px; padding-left: 40px; padding-right: 40px; font-weight: 500;">
                                                            <a href="#"
                                                               style="color: #ffffff; font-size: 12px; text-decoration: none; text-transform: uppercase; line-height: 34px;">More
                                                                Information</a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>-->
                                        </tbody>
                                    </table>
                                    <!-- /button -->

                                </td>
                            </tr>
                            <tr>
                                <td width="100%" height="50"></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>

            <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center">
                <tbody>
                <tr>
                    <td width="100%" valign="top" align="center">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#fafafa">
                            <tbody>
                            <tr>
                                <td width="100%" height="50"></td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <!-- Post -->
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                        <tbody>
                                        <tr>
                                            <td width="100%" align="center">
                                                <table width="70%" border="0" cellpadding="0" cellspacing="0"
                                                       align="center">
                                                    <tbody>
                                                    <!--<tr>
                                                            <td width="100%">
                                                                <a href="#">
                                                                    <img src="{{asset('/global-assets/images/placeholders/cover.jpg')}}"
                                                                         alt="" border="0" width="600" height="auto"
                                                                         style="border-radius: 4px;">
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="100%" height="25"></td>
                                                        </tr>-->
                                                    <tr>
                                                        <td>
                                                            <table border="0" width="100%" border="0" cellpadding="0"
                                                                   cellspacing="0"
                                                                   style="border-bottom:1px solid slategray !important;">
                                                                <tr>
                                                                    <th style="text-transform: uppercase;width:50%;font-weight: bold;background-color: #f67b7c;padding: 18px;color: white;border:1px solid slategray;border-right: 0 !important;">
                                                                    <!--<img src="/uploads/img/gammes/{{$gamme->nom}}.svg"/>
                                                                           <br> -->{{$formule->nom}}
                                                                    </th>
                                                                    <th style="text-transform: uppercase;width:50%;font-weight: bold;background-color: #f67b7c;padding: 18px;color: white;border:1px solid slategray;">
                                                                        Garanties
                                                                    </th>
                                                                </tr>
                                                                @foreach($ArrayVolets as $key => $volet)
                                                                    <tr>
                                                                        <td style="text-transform: uppercase;width:50%;font-weight: bold;background-color: #fbc4c4;padding: 8px;color: #000000;border-right:1px solid slategray !important;border-left:1px solid slategray !important;"
                                                                            colspan="2" align="center">
                                                                            {{$key}}
                                                                        </td>
                                                                    </tr>
                                                                    @foreach($volet as $Svolet)
                                                                        <tr>
                                                                            <td style="width:50%;background-color: #fdefef;padding: 10px;color: #000000;border-left:1px solid slategray !important;"
                                                                                align="center">
                                                                                {{$Svolet->valeur}}
                                                                            </td>
                                                                            <td style="width:50%;background-color: #fdefef;padding: 10px;color: #000000;border-right:1px solid slategray !important;"
                                                                                align="center">
                                                                                {{$Svolet->garantie}}
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endforeach
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="100%" height="35"></td>
                                                    </tr>
                                                    <!--<tr>
                                                        <td height="35" width="100%" align="center"
                                                            style="font-size: 24px; color: #444444; line-height: 32px; font-weight: 500;">
                                                            We have a Great Workspace
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="100%" height="15"></td>
                                                    </tr>-->
                                                    <tr>
                                                        <td valign="middle" width="100%" align="left"
                                                            style="font-size: 14px; color: #808080; line-height: 22px;">
                                                            Les remboursements exprimés en pourcentage de la BRSS*
                                                            incluent la prise en charge du Régime de Base. Les montants
                                                            exprimés en euros interviennent en complément de
                                                            l’éventuelle part du régime de base. Les forfaits intégrant
                                                            une limite annuelle s’appliquent par bénéfi ciaire et par
                                                            année d’adhésion, soit par période de 12 (douze) mois
                                                            successifs à compter de la date d’effet de la garantie ou
                                                            des Renforts optionnels à l’exception des Équipements
                                                            Optique pour lesquels la prestation est biennale. Les
                                                            remboursements ne peuvent dépasser les frais restant à la
                                                            charge du bénéfi ciaire des prestations. Les garanties du
                                                            présent contrat s’inscrivent dans le cadre du dispositif
                                                            législatif des contrats d’assurances visés à l’article L.
                                                            871-1 du Code de la Sécurité sociale dits “contrats
                                                            responsables”.
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="100%" height="30"></td>
                                                    </tr>
                                                    <!--<tr>
                                                        <td width="auto" align="center">
                                                            <table border="0" cellpadding="0" cellspacing="0"
                                                                   align="center">
                                                                <tbody>
                                                                <tr>
                                                                    <td width="auto" align="center" height="38"
                                                                        bgcolor="#fa6f6f"
                                                                        style="border-radius: 20px; padding-left: 22px; padding-right: 22px;">
                                                                        <a href="#"
                                                                           style="color: #ffffff; font-size: 12px; text-decoration: none; text-transform: uppercase; font-weight: 500; line-height: 32px; width: 100%;">Read
                                                                            more</a>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>-->
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!-- /post -->

                                </td>
                            </tr>
                            <tr>
                                <td width="100%" height="50"></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>

            <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center">
                <tbody>
                <tr>
                    <td width="100%" height="1" bgcolor="#dddddd" style="font-size: 1px; line-height: 1px;">&nbsp;
                    </td>
                </tr>
                <tr>
                    <td align="center" width="100%" valign="top" bgcolor="#fafafa"
                        style="background-color: #fafafa;">
                        <table width="640" border="0" cellpadding="0" cellspacing="0" align="center">
                            <tbody>
                            <tr>
                                <td width="100%" height="50"></td>
                            </tr>
                            <tr>
                                <td align="center">

                                    <!-- Header -->
                                    <table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
                                        <tbody>
                                        <tr>
                                            <td align="center">
                                                <table width="600" border="0" cellpadding="0" cellspacing="0"
                                                       align="center">
                                                    <tbody>
                                                    <tr>
                                                        <td align="center" valign="middle"
                                                            style="font-size: 24px; color: #444444; line-height: 32px; font-weight: 500;">
                                                            Notre mission
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="100%" height="30"></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="100%">
                                                            <table width="100" border="0" cellpadding="0"
                                                                   cellspacing="0" align="center">
                                                                <tbody>
                                                                <tr>
                                                                    <td height="1" bgcolor="#f67b7c"
                                                                        style="font-size: 1px; line-height: 1px;">
                                                                        &nbsp;
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="100%" height="30"></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" valign="middle" width="100%"
                                                            style="font-size: 14px; color: #808080; line-height: 22px; font-weight: 400;">
                                                            Nous vous accompagnons dans le choix des garanties le plus
                                                            adaptées à votre situation, nous vous proposerons des tarifs
                                                            atractifs sans rogner sur la qualité des garanties et
                                                            services.
                                                            <br>
                                                            Parce que le meilleur prix n’est pas toujours la meilleure
                                                            chose pour vous, nous choisissons ensemble le bon compromis
                                                            en fonction de votre situation.
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="100%" height="30"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!-- /header -->


                                    <!-- Prices -->
                                    <table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
                                        <tbody>
                                        <tr>
                                            <td width="100%" valign="top" align="center">

                                                <!-- Basic license -->
                                                <!--<table width="290" border="0" cellpadding="0" cellspacing="0"
                                                       align="left" bgcolor="#ffffff"
                                                       style="border: 1px solid #dddddd; background-color: #ffffff;">
                                                    <tbody>
                                                    <tr>
                                                        <td width="290" valign="top" align="center">
                                                            <table width="294" border="0" cellpadding="0"
                                                                   cellspacing="0" align="center">
                                                                <tbody>
                                                                <tr>
                                                                    <td height="15">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center"
                                                                        style="color: #444444; font-size: 17px; line-height: 24px; padding: 0px 5px; font-weight: 500;">
                                                                        Regular License
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
                                                                    <td align="center"
                                                                        style="color: #808080; font-size: 14px; line-height: 22px; padding: 2px 5px; font-weight: 400;">
                                                                        Non-Responsive layout
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="10">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="text-align: center; color: #808080; font-size: 14px; line-height: 22px; padding: 2px 5px;">
                                                                        Builder excluded
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="10">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="text-align: center; color: #808080; font-size: 14px; line-height: 22px; padding: 2px 5px;">
                                                                        Instant Access
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="25">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="24"
                                                                        style="text-align: center; color: #444444; font-size: 38px; line-height: 15px; padding: 6px 5px 6px 5px; font-weight: 700;">
                                                                        <span style="font-size: 18px; position: relative; bottom: 12px;">$ </span>49<span
                                                                                style="font-size: 14px; color: #808080; font-style: italic;"> / month</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="25">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="auto" align="center">
                                                                        <table border="0" cellpadding="0"
                                                                               cellspacing="0" align="center">
                                                                            <tbody>
                                                                            <tr>
                                                                                <td width="auto" align="center"
                                                                                    height="38" bgcolor="#fa6f6f"
                                                                                    style="border-radius: 20px; padding-left: 22px; padding-right: 22px; font-weight: 500;">
                                                                                    <a href="#"
                                                                                       style="color: #ffffff; font-size: 12px; text-decoration: none; text-transform: uppercase; line-height: 32px;">Sign
                                                                                        Up</a>
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
                                                </table>-->
                                                <!-- /basic license -->


                                                <!-- Space -->
                                                <!--<table width="1" border="0" cellpadding="0" cellspacing="0"
                                                       align="left">
                                                    <tbody>
                                                    <tr>
                                                        <td width="100%" height="30"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>-->
                                                <!-- /space -->


                                                <!-- OEM license -->
                                                <!--<table width="290" border="0" cellpadding="0" cellspacing="0"
                                                       align="right" bgcolor="#ffffff"
                                                       style="border: 1px solid #dddddd; background-color: #ffffff;">
                                                    <tbody>
                                                    <tr>
                                                        <td width="294" valign="top">
                                                            <table width="290" border="0" cellpadding="0"
                                                                   cellspacing="0" align="center">
                                                                <tbody>
                                                                <tr>
                                                                    <td height="15">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center"
                                                                        style="color: #444444; font-size: 17px; line-height: 26px; padding: 0px 5px; font-weight: 500;">
                                                                        OEM License
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
                                                                    <td align="center"
                                                                        style="color: #808080; font-size: 14px; line-height: 22px; padding: 2px 5px;">
                                                                        Responsive layout
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="10">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center"
                                                                        style="color: #808080; font-size: 14px; line-height: 22px; padding: 2px 5px;">
                                                                        Builder included
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="10">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center"
                                                                        style="color: #808080; font-size: 14px; line-height: 22px; padding: 2px 5px;">
                                                                        Instant Access
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="25">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center" height="24"
                                                                        style="color: #444444; font-size: 38px; line-height: 15px; padding: 6px 5px 6px 5px; font-weight: 700;">
                                                                        <span style="font-size: 18px; position: relative; bottom: 12px;">$ </span>80<span
                                                                                style="font-size: 14px; color: #808080; font-style: italic;"> / month</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="25">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="auto" align="center">
                                                                        <table border="0" cellpadding="0"
                                                                               cellspacing="0" align="center">
                                                                            <tbody>
                                                                            <tr>
                                                                                <td width="auto" align="center"
                                                                                    height="38" bgcolor="#fa6f6f"
                                                                                    style="border-radius: 20px; padding-left: 22px; padding-right: 22px; font-weight: 500;">
                                                                                    <a href="#"
                                                                                       style="color: #ffffff; font-size: 12px; text-decoration: none; text-transform: uppercase; line-height: 32px;">Sign
                                                                                        Up</a>
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
                                                </table>-->
                                                <!-- /OEM license -->

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!-- /prices -->

                                </td>
                            </tr>
                            <tr>
                                <td height="60"></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>

            <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center">
                <tbody>
                <tr>
                    <td align="center" width="100%" valign="top" bgcolor="#4f97e2">
                        <table width="640" border="0" cellpadding="0" cellspacing="0" align="center">
                            <tbody>
                            <tr>
                                <td width="100%" height="50"></td>
                            </tr>
                            <tr>
                                <td align="center">

                                    <!-- Header -->
                                    <table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
                                        <tbody>
                                        <tr>
                                            <td valign="middle" align="center" width="100%"
                                                style="font-size: 24px; color: #ffffff; line-height: 32px; font-weight: 500;">
                                                Nos partenaires
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="100%" height="30"></td>
                                        </tr>
                                        <tr>
                                            <td width="100%">
                                                <table width="100" border="0" cellpadding="0" cellspacing="0"
                                                       align="center">
                                                    <tbody>
                                                    <tr>
                                                        <td width="100" height="1" bgcolor="#ffffff"
                                                            style="font-size: 1px; line-height: 1px;">&nbsp;
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <!--<tr>
                                            <td width="100%" height="30"></td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="middle" width="100%"
                                                style="font-size: 14px; color: #ffffff; line-height: 22px;">
                                                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                                officia deserunt <b>mollit anim id est laborum</b>. Sed ut
                                                perspiciatis
                                                unde omnis iste...
                                            </td>
                                        </tr>-->
                                        <tr>
                                            <td width="100%" height="30"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!-- /header -->


                                    <!-- Testimonials -->
                                    <table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
                                        <tbody>
                                        <tr>
                                            <td width="100%">

                                                <!-- Left table -->
                                                <table width="275" border="0" cellpadding="0" cellspacing="0"
                                                       align="left" bgcolor="#ffffff" style="border-radius: 4px;">
                                                    <tbody>
                                                    <tr>
                                                        <td width="100%" align="center">
                                                            <a href="#">
                                                                <img src="{{asset('/global-assets/images/placeholders/placeholder.jpg')}}"
                                                                     alt="" border="0" width="83" height="auto"
                                                                     style="border-radius: 100px;">
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="30"></td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="middle" align="center"
                                                            style="font-size: 14px; color: #ffffff; line-height: 22px;">
                                                            Excepteur sint occaecat cupidatat non proident id est
                                                            laborum.
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="20"></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center"
                                                            style="font-size: 15px; color: #ffffff; line-height: 22px;">
                                                            <span style="font-weight: 700; font-size: 12px; text-transform: uppercase; color: #fff;">Cris Costo</span>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <!-- /left table -->


                                                <!-- Space -->
                                                <table width="1" border="0" cellpadding="0" cellspacing="0"
                                                       align="left">
                                                    <tbody>
                                                    <tr>
                                                        <td width="100%" height="40"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <!-- /space -->


                                                <!-- Right table -->
                                                <table width="275" border="0" cellpadding="0" cellspacing="0"
                                                       align="right" style="border-radius: 4px;" bgcolor="#ffffff">
                                                    <tbody>
                                                    <tr>
                                                        <td width="100%" align="center">
                                                            <a href="#">
                                                                <img src="{{asset('/global-assets/images/placeholders/placeholder.jpg')}}"
                                                                     alt="" border="0" width="83" height="auto"
                                                                     style="border-radius: 100px;">
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="30"></td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="middle" align="center"
                                                            style="font-size: 14px; color: #ffffff; line-height: 22px;">
                                                            Sunt in culpa qui officia deserunt mollit anim id est
                                                            laborum.
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="20"></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center"
                                                            style="font-size: 15px; line-height: 22px;">
                                                            <span style="font-weight: 700; font-size: 12px; text-transform: uppercase; color: #ffffff;">Jason Kenny</span>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <!-- /right table -->

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!-- /testimonials -->

                                </td>
                            </tr>
                            <tr>
                                <td width="100%" height="50"></td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>

            <table width="90%" border="0" cellpadding="0" cellspacing="0" align="center">
                <tbody>
                <tr>
                    <td align="center" width="100%" valign="top" bgcolor="#344b61">

                        <!-- Wrapper -->
                        <table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
                            <tbody>
                            <tr>
                                <td width="100%" height="40" align="center" valign="middle"
                                    style="font-size: 12px; color: #aebecd;">
                                    <a href="#" style="color: #ffffff;">text 1</a>

                                    <span style="color: #ffffff;">&nbsp;/&nbsp;</span>

                                    <a href="#" style="color: #ffffff;">text 1</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <!-- /wrapper -->

                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>




