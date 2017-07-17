@extends('layouts.app')

@section('after_styles')
{{--    <link href="{{ asset('css/home.css') }}" rel="stylesheet">--}}
{{--    <link href="{{ asset('css/home-cardslist.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('css/package-box.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

@endsection
@section('content')

    <div class="container">
        <h2 class="text-center section-title">Packages</h2>
        <hr>
        <div class="text-center">
            <div class="categories">
                <ul>
                    <li>
                        <a href="#" data-filter=".all">All</a>
                    </li>
                    <li>
                        <a href="#" data-filter=".apps">Free</a>
                    </li>
                    <li class="active">
                        <a href="#" data-filter=".psd">Paid</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-14 col-md-offset-1">
                {{--<div class="title"><span>Packages</span></div>--}}
                @foreach($all_packages as $package)
                    <div class="col-sm-3 col-md-2 box-product-outer">
                        <div class="box-product">
                            <div class="img-wrapper">
                                <a href="detail.html">
                                    <img alt="Product" src="https://github.com/autopear/Cydia/raw/master/MobileCydia.app/Sections/Tweaks.png">
                                </a>
                                <div class="tags">
                                    <h4 class="label-tags"><span class="label label-danger">Sale</span></h4>
                                    <h4 class="label-tags2"><span class="label label-primary">$1.99</span></h4>
                                </div>
                                <div class="option">
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Purchase"><i class="ace-icon fa fa-credit-card"></i></a>
                                    <a href="{{url('debs/'.$package->package_hash)}}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Download"><i class="ace-icon fa fa-arrow-circle-down"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Info"><i class="ace-icon fa fa-info-circle"></i></a>
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Comments"><i class="ace-icon fa fa-comments"></i></a>
                                </div>
                            </div>
                            <h5><a href="/repo/depiction/{{$package->package_hash}}">{{$package->Name}}</a></h5>
                            <div class="price">
{{--                                <div>{{$package->Price}}</div>--}}
                                {{--<span class="price-old">$3.00</span>--}}
                            </div>
                            <div class="rating">
                                <i class="ace-icon fa fa-star-o"></i>
                                <i class="ace-icon fa fa-star-o"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{--@for($i = 1; $i <= 10; $i++)--}}

                    {{--<div class="col-sm-3 col-md-2 box-product-outer">--}}
                        {{--<div class="box-product">--}}
                            {{--<div class="img-wrapper">--}}
                                {{--<a href="detail.html">--}}
                                    {{--<img alt="Product" src="https://cdn0.iconfinder.com/data/icons/social-flat-rounded-rects/512/whatsapp-512.png">--}}
                                {{--</a>--}}
                                {{--<div class="tags">--}}
                                    {{--<h4 class="label-tags"><span class="label label-danger">Sale</span></h4>--}}
                                    {{--<h4 class="label-tags2"><span class="label label-primary">$1.99</span></h4>--}}
                                {{--</div>--}}
                                {{--<div class="option">--}}
                                    {{--<a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Purchase"><i class="ace-icon fa fa-credit-card"></i></a>--}}
                                    {{--<a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Download"><i class="ace-icon fa fa-arrow-circle-down"></i></a>--}}
                                    {{--<a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Info"><i class="ace-icon fa fa-info-circle"></i></a>--}}
                                    {{--<a href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Comments"><i class="ace-icon fa fa-comments"></i></a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<h5><a href="detail.html">WAEnhancer {{$i}}</a></h5>--}}
                            {{--<div class="price">--}}
                                {{--<div>$1.50<span class="price-down">-50%</span></div>--}}
                                {{--<span class="price-old">$3.00</span>--}}
                            {{--</div>--}}
                            {{--<div class="rating">--}}
                                {{--@if($i == 0)--}}
                                    {{--<i class="ace-icon fa fa-star-o"></i>--}}
                                    {{--<i class="ace-icon fa fa-star-o"></i>--}}
                                    {{--<i class="ace-icon fa fa-star-o"></i>--}}
                                    {{--<i class="ace-icon fa fa-star-o"></i>--}}
                                    {{--<i class="ace-icon fa fa-star-o"></i>--}}
                                    {{--<a href="#">({{$i*275}} reviews)</a>--}}
                                {{--@elseif($i == 1)--}}
                                    {{--<i class="ace-icon fa fa-star"></i>--}}
                                    {{--<i class="ace-icon fa fa-star-o"></i>--}}
                                    {{--<i class="ace-icon fa fa-star-o"></i>--}}
                                    {{--<i class="ace-icon fa fa-star-o"></i>--}}
                                    {{--<i class="ace-icon fa fa-star-o"></i>--}}
                                    {{--<a href="#">({{$i*275}} reviews)</a>--}}
                                {{--@elseif($i == 2)--}}
                                    {{--<i class="ace-icon fa fa-star"></i>--}}
                                    {{--<i class="ace-icon fa fa-star"></i>--}}
                                    {{--<i class="ace-icon fa fa-star-o"></i>--}}
                                    {{--<i class="ace-icon fa fa-star-o"></i>--}}
                                    {{--<i class="ace-icon fa fa-star-o"></i>--}}
                                    {{--<a href="#">({{$i*275}} reviews)</a>--}}
                                {{--@elseif($i == 3)--}}
                                    {{--<i class="ace-icon fa fa-star"></i>--}}
                                    {{--<i class="ace-icon fa fa-star"></i>--}}
                                    {{--<i class="ace-icon fa fa-star"></i>--}}
                                    {{--<i class="ace-icon fa fa-star-o"></i>--}}
                                    {{--<i class="ace-icon fa fa-star-o"></i>--}}
                                    {{--<a href="#">({{$i*275}} reviews)</a>--}}
                                {{--@elseif($i == 4)--}}
                                    {{--<i class="ace-icon fa fa-star"></i>--}}
                                    {{--<i class="ace-icon fa fa-star"></i>--}}
                                    {{--<i class="ace-icon fa fa-star"></i>--}}
                                    {{--<i class="ace-icon fa fa-star"></i>--}}
                                    {{--<i class="ace-icon fa fa-star-o"></i>--}}
                                    {{--<a href="#">({{$i*275}} reviews)</a>--}}
                                {{--@elseif($i == 5)--}}
                                    {{--<i class="ace-icon fa fa-star"></i>--}}
                                    {{--<i class="ace-icon fa fa-star"></i>--}}
                                    {{--<i class="ace-icon fa fa-star"></i>--}}
                                    {{--<i class="ace-icon fa fa-star"></i>--}}
                                    {{--<i class="ace-icon fa fa-star"></i>--}}
                                    {{--<a href="#">({{$i*275}} reviews)</a>--}}
                                {{--@else--}}
                                    {{--<i class="ace-icon fa fa-star"></i>--}}
                                    {{--<i class="ace-icon fa fa-star"></i>--}}
                                    {{--<i class="ace-icon fa fa-star"></i>--}}
                                    {{--<i class="ace-icon fa fa-star"></i>--}}
                                    {{--<i class="ace-icon fa fa-star"></i>--}}
                                    {{--<a href="#">({{$i*275}} reviews)</a>--}}
                                {{--@endif--}}

                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endfor--}}
            </div>
        </div>
        <div class="text-center">
            <ul class="pagination">
                <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
            </ul>
        </div>

        </div>
    {{--</div>--}}

    {{--<div class="directory-info-row">--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-6 col-sm-6">--}}
                {{--<div class="panel">--}}
                    {{--<div class="panel-body">--}}
                        {{--<div class="media">--}}
                            {{--<a class="pull-left" href="#">--}}
                                {{--<img class="thumb media-object" src="https://github.com/autopear/Cydia/raw/master/MobileCydia.app/Sections/Tweaks.png" alt="">--}}
                            {{--</a>--}}
                            {{--<div class="media-body">--}}
                                {{--<h4>John Doe <span class="text-muted small"> - UI Engineer</span></h4>--}}
                                {{--<ul class="social-links">--}}
                                    {{--<li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>--}}
                                    {{--<li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>--}}
                                    {{--<li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="LinkedIn"><i class="fa fa-linkedin"></i></a></li>--}}
                                    {{--<li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Skype"><i class="fa fa-skype"></i></a></li>--}}
                                {{--</ul>--}}
                                {{--<address>--}}
                                    {{--<strong>Description: </strong>--}}
                                    {{--Vamoil Ave, Suite 23--}}
                                    {{--Dream land, Australia--}}
                                    {{--Vamoil Ave, Suite 23--}}
                                    {{--Dream land, Australia--}}
                                    {{--Vamoil Ave, Suite 23--}}
                                    {{--Dream land, Australia--}}
                                    {{--<abbr title="Phone">P:</abbr> (142) 454-7890--}}
                                {{--</address>--}}

                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection
@section('after_scripts')
@endsection