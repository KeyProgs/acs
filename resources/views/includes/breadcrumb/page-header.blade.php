<!--Start breadcrumb area-->
<section class="breadcrumb-area" style="background-image: url({{asset('images/resources/breadcrumb-bg.jpg')}});">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="inner-content clearfix">
                    <div class="title">
                        <h1>{{$title}}</h1>
                    </div>
                    <div class="breadcrumb-menu">
                        <ul class="clearfix">
                            <li><a href="#">{{$home}}</a></li>
                            @if($page!=null)
                                <li class="active">{{$page}}</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End breadcrumb area-->