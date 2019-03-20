<!--Start mainmenu area style2-->
<section class="mainmenu-area style2 stricky">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="inner-content clearfix">
                    <nav class="main-menu clearfix">
                        <div class="navbar-header clearfix">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                    data-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="navbar-collapse collapse clearfix">
                            <ul class="navigation clearfix">
                                <li class="current"><a href="{{url('/')}}">Accueil</a>

                                </li>
                                <li class="dropdown"><a href="#">PRODUITS</a>
                                    <ul>
                                        @foreach($types_assurance as $type)
                                            <li><a title="{{$type->nom}}" href="#">{{ucfirst($type->nom)}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a title="blog" href="#">BLOG</a></li>

                                <li><a title="autre" href="#">AUTRE</a></li>

                                 <!--<li class="dropdown"><a href="#sante">Santé</a>
                                      <ul>
                                          <li><a href="#">sante 1</a></li>
                                          <li><a href="#">sante 2</a></li>
                                          <li><a href="#">sante 3</a></li>
                                          <li><a href="#">sante 4</a></li>
                                      </ul>
                                  </li>-->


                                <!--<li class="dropdown"><a href="shop.html">Shop</a>
                                <ul>
                                </ul>
                                </li>-->

                                @if(Session::get('user') != null && Session::get('user')->type=='client')
                                    <li class="dropdown"><a href="#">@lang('content.mon_espace')</a>
                                        <ul>
                                            <li>
                                                <a href="{{Helper::url(Lang::get('routes.espace_client').'/'.Lang::get('routes.mon_profile'))}}">@lang('content.mon_profile')</a>
                                            </li>

                                            <li>
                                                <a href="{{Helper::url(Lang::get('routes.espace_client').'/'.Lang::get('routes.mes_devis'))}}">@lang('content.liste_devis')</a>
                                            </li>
                                        </ul>
                                    </li>
                                @else
                                    <li class="dropdown"><a href="#">@lang('content.espace_client')</a>
                                        <ul>
                                            <li>
                                                <a title="Acs Assurance - Connexion" href="{{Helper::url(Lang::get('routes.connexion'))}}">@lang('content.connexion')</a>
                                            </li>
                                            <li>
                                                <a title="Acs Assurance - Inscription" href="{{Helper::url(Lang::get('routes.inscription'))}}">@lang('content.inscription')</a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif

                                <li>
                                    <a title="Acs Assurance" href="{{Helper::url(Lang::get('routes.contact'))}}">@lang('content.contactez_nous')</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="outer-search-box">
                        <div class="seach-toggle"><i class="fa fa-search"></i></div>
                        <ul class="search-box">
                            <li>
                                <form method="post" action="#">
                                    <div class="form-group">
                                        <input type="search" name="search" placeholder="Chercher Ici" required>
                                        <button type="submit"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="button">
                        <a href="#"><span class="flaticon-calendar-1"></span>Make an Appointment</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End mainmenu area style2-->