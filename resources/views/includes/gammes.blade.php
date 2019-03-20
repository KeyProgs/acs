<!--gammes section-->
<section id="shop-area" class="main-shop-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 float-right">
                <div class="shop-content">
                    <div class="row">
                        @foreach($gammes as $gamme)
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                <div class="single-product-item">
                                    <div class="img-holder">
                                        <img style="width: 50% !important;margin-left: 25% !important;"
                                             src="images/gammes/{{$gamme->nom}}.png"
                                             alt="Acs Assurance - {{$gamme->nom}}">
                                    </div>
                                    <div class="title-holder text-center">
                                        <h3><a href="#{{$gamme->nom}}">{{ucfirst($gamme->nom)}}</a></h3>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--gammes section-->