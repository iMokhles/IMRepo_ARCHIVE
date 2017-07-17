{{--/**--}}
 {{--* Created by PhpStorm.--}}
 {{--* User: imokhles--}}
 {{--* Date: 21/06/2017--}}
 {{--* Time: 20:05--}}
 {{--*/--}}

@extends('layouts.depiction')

@section('after_styles')
    <script src="https://use.fontawesome.com/f37af914d5.js"></script>
    <link rel="stylesheet" href="{{ asset('css/depiction.css') }}">
@endsection
@section('header_title')
   {{$package->Name}}
@endsection

@section('compatible')
    <h2 role="header">compatible</h2>
    <div data-min-ios="{{$depiction->mini_ios}}" data-max-ios="{{$depiction->max_ios}}" class="prerequisite">
    </div>
    <ul>
        <li>
            Support iOS {{$depiction->mini_ios}} to {{$depiction->max_ios}}
        </li>
    </ul>
@endsection

@section('description')
    <h2 role="header">Description</h2>
    <ul>
        <li>
            {!! $depiction->long_description !!}
        </li>
    </ul>
@endsection

@section('screenshots')
    <h2 role="header">Screenshots</h2>
    <ul>
        <li>
            <div class="w3-content w3-display-container">
                @foreach(\App\Helpers\IMHelper::allScreenShots($package->id) as $screenshot)
                    <a href="{{url("repo/screenshot/$screenshot->image_hash")}}"><img class="mySlides" style="width: 20%; height: 20%;" src="{{url("repo/screenshot/$screenshot->image_hash")}}" style="width:100%"></a>
                @endforeach

                <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
                <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
            </div>
        </li>
    </ul>

@endsection

@section('last_changelog')
    <h2 role="header">{{$package->Version}} ChangeLog</h2>
    <ul>
        {!! \App\Helpers\IMHelper::first("changelogs", [
                'package_version' => $package->Version,
                'package_hash' => $package->package_hash,
            ])->changelog_text !!}
    </ul>
@endsection

@section('package_info')
    <h2 role="header">Package Info</h2>

    <ul>
        <li>
            <dl>
                <dt>Last Version</dt>
                <dd>{{\App\Helpers\IMHelper::getLastVersionAvailabe($package->Package)}}</dd>
                <dt>Downloads</dt>
                <dd>{{ $package->Downloads }}</dd>
                <dt>Price</dt>
                <dd>{{$depiction->price}}</dd>
                <dt>Updated</dt>
                <dd>
                    <time datetime="{{$package->created_at}}">{{\App\Helpers\IMHelper::formatDateWithHour($package->created_at)}}</time>
                </dd>
                <dt>Devices</dt>
                <dd>{{$depiction->devices_support}}</dd>
                <dt>iOS</dt>
                <dd>{{$depiction->mini_ios}} to {{$depiction->max_ios}}</dd>
                <dt>Size</dt>
                <dd>{{\App\Helpers\IMHelper::formatBytes($package->Size)}}</dd>
            </dl>
            <div class="clear"></div>
        </li>
        <li><a href="/changelog" role="button" target="_blank"><i class="fa fa-refresh"></i> Full ChangeLog</a></li>
        <li><a href="{{Config::get('settings.support_url')}}" role="button"><i class="fa fa-life-ring"></i> Support</a></li>
        <li><a href="{{Config::get('settings.donate_url')}}" role="button"><i class="fa fa-credit-card"></i> Donate</a></li>
        <li><a href="{{Config::get('settings.site_url')}}" role="button"><i class="fa fa-globe"></i> Website</a></li>
    </ul>
@endsection

@section('after_scripts')
    <script>
        var slideIndex = 1;
        showDivs(slideIndex);

        function plusDivs(n) {
            showDivs(slideIndex += n);
        }

        function showDivs(n) {
            var i;
            var x = document.getElementsByClassName("mySlides");
            if (n > x.length) {slideIndex = 1}
            if (n < 1) {slideIndex = x.length}
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            x[slideIndex-1].style.display = "block";
        }
    </script>

    <script id="prerequisite-supported" type="text/x-template">
        <svg class="icon icon-check">
            <use xlink:href="/css/icons.svg?rev=2#icon-check"></use>
        </svg> Your iOS version is supported.
    </script>
    <script id="prerequisite-needs-upgrade" type="text/x-template">
        <svg class="icon icon-info">
            <use xlink:href="/css/icons.svg?rev=2#icon-info"></use>
        </svg> This package requires an upgrade to at least iOS {{$depiction->mini_ios}}.
    </script>
    <script id="prerequisite-unconfirmed" type="text/x-template">
        <svg class="icon icon-info">
            <use xlink:href="/css/icons.svg?rev=2#icon-info"></use>
        </svg> This package is not yet confirmed to work on iOS %s.
    </script>
    <script id="prerequisite-unsupported" type="text/x-template">
        <svg class="icon icon-info">
            <use xlink:href="/css/icons.svg?rev=2#icon-info"></use>
        </svg> This package is currently only compatible with iOS {{$depiction->mini_ios}} to {{$depiction->max_ios}}.
    </script>

@endsection