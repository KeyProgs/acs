<div class="language-switcher float-right">
    <div id="polyglotLanguageSwitcher">
        <form action="">
            <select id="polyglot-language-options">
                <option id="{{url('/')}}" value="fr" @if(App::getLocale()=="fr") selected @endif >FR</option>
                <option id="{{url('/en')}}" value="en" @if(App::getLocale()=="en") selected @endif>EN</option>
                <option id="{{url('/ar')}}" value="ar" @if(App::getLocale()=="ar") selected @endif>AR</option>
            </select>
        </form>
    </div>
</div>