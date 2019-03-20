@extends('layouts.app')
@section('content')
    @include('includes.breadcrumb.page-header',['home'=>'accueil','page'=>'connexion','title'=>'Connexion'])
    <!--Start login area-->
    <section class="login-register-area">
        <div class="container">
            <div class="row">
                <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-6 col-sm-12">
                    @if(Session::has('message'))
                        <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-styled-left rounded-0"
                             id="fiche-alert">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span>
                                <span class="sr-only">Close</span></button>
                            <h4 class="alert-heading">warning !</h4>
                            <p class="mb-0">
                                {{ Session::get('message') }}
                            </p>
                        </div>
                    @endif
                    <div class="form">
                        <div class="title-box">
                            <h3>@lang('content.connecte_maintenant')</h3>
                        </div>
                        <div class="row">
                            <form action="{{url('/connexion')}}" method="post">
                                @csrf
                                <div class="col-xl-12">
                                    <div class="input-field">
                                        <input type="text" name="email"
                                               placeholder="@lang('content.votre_email_adresse')"
                                               value="{{old('email')}}">
                                        <div class="icon-holder">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                        </div>
                                        @if($errors->has('email'))
                                            <span class="error text-danger">*{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>


                                </div>
                                <div class="col-xl-12">
                                    <div class="input-field">
                                        <input type="password" name="password"
                                               placeholder="@lang('content.votre_mot_de_passe')">
                                        <div class="icon-holder">
                                            <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                        </div>
                                        @if($errors->has('password'))
                                            <span class="error text-danger">*{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-sm-12">
                                            <button class="btn-one thm-bg-clr"
                                                    type="submit">@lang('content.se_connecter')</button>
                                            <div class="remember-text">
                                                <div class="checkbox">
                                                    <label>
                                                        <input name="remember" type="checkbox" name="remember"
                                                               id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                        <span>@lang('content.se_souvenir_de_moi')</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-sm-12">
                                            <!--<ul class="social-icon">
                                                <li class="login-with">Or login with</li>
                                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                                </li>
                                                <li><a href="#"><i class="fa fa-twitter twitter" aria-hidden="true"></i></a>
                                                </li>
                                                <li><a href="#"><i class="fa fa-google-plus gplus"
                                                                   aria-hidden="true"></i></a>
                                                                   </li>
                                            </ul>-->
                                            <a class="forgot-password" href="#">Mot de passe oublié ?</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End login area-->
@endsection