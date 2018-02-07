@extends('layouts.app')

@section('after_styles')
    <link href="{{ asset('css/package_info.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

@endsection
@section('content')

    <div class="container bootstrap snippet">
        <div class="row ng-scope">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <div class="pv-lg"><img class="center-block img-responsive img-circle img-thumbnail thumb96" src="{{url('repo/icon/'.$package->Section)}}" alt="Contact"></div>
                        <h3 class="m0 text-bold">{{$package->Name}}</h3>
                        <div class="mv-lg">
                            <p>{{$package->Description}}</p>
                        </div>
                        <div class="text-center"><a class="btn btn-primary" href="{{url('debs/'.$package->package_hash)}}"><i class="fa fa-arrow-circle-down" style="font-size: 17px;"></i> Download</a></div>
                    </div>
                    <br>
                    <div class="mv-lg" style="margin-left: 10px;">
                        <p>Latest ChangeLog</p>
                    </div>
                    <ul style="margin-left: -40px;">
                        {!! \App\Helpers\IMHelper::first("changelogs", [
                                'package_version' => $package->Version,
                                'package_hash' => $package->package_hash,
                            ])->changelog_text !!}
                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div></div>
                    <br>
                    <div class="h4 text-center">Reviews</div>
                    <div class="row">
                        {{--<div class="col-lg-2"></div>--}}
                        {{--<div class="col-lg-8">--}}
                            <div class="blog-comment">
                                <ul class="comments">
                                    <li class="clearfix">
                                        <img src="https://bootdey.com/img/Content/user_1.jpg" class="avatar" alt="">
                                        <div class="post-comments">
                                            <p class="meta">Dec 18, 2014 <a href="#">JohnDoe</a> <i class="pull-right"><a href="#"><small>Reply</small></a></i></p>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                Etiam a sapien odio, sit amet
                                            </p>
                                        </div>
                                    </li>
                                    <li class="clearfix">
                                        <img src="https://bootdey.com/img/Content/user_2.jpg" class="avatar" alt="">
                                        <div class="post-comments">
                                            <p class="meta">Dec 19, 2014 <a href="#">JohnDoe</a> <i class="pull-right"><a href="#"><small>Reply</small></a></i></p>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                Etiam a sapien odio, sit amet
                                            </p>
                                        </div>

                                        <ul class="comments">
                                            <li class="clearfix">
                                                <img src="https://bootdey.com/img/Content/user_3.jpg" class="avatar" alt="">
                                                <div class="post-comments">
                                                    <p class="meta">Dec 20, 2014 <a href="#">JohnDoe</a> <i class="pull-right"><a href="#"><small>Reply</small></a></i></p>
                                                    <p>
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam a sapien odio, sit amet
                                                    </p>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('after_scripts')
@endsection