@extends('layouts.app')

@section('after_styles')
{{--    <link href="{{ asset('css/home.css') }}" rel="stylesheet">--}}
{{--    <link href="{{ asset('css/home-cardslist.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('css/package-box.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

@endsection
@section('header')
    <div class="container">
        <section class="content-header">
            <h1>
                Packages
                <small>List</small>
            </h1>
        </section>
    </div>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            @if(count($all_packages) > 0)
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"></h3>

                        <div class="box-tools">
                            <form class="navbar-form navbar-left" role="search" method="GET" action="/">
                                <div class="input-group input-group-sm" style="width: 250px;">
                                    <input type="text" name="q" class="form-control pull-right" placeholder="Search">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                {{--<th style="width: 10px">#</th>--}}
                                <th>Name</th>
                                <th style="width: 40px">Section</th>
                                <th style="width: 40px">Downloads</th>
                                <th style="width: 70px">Actions</th>
                            </tr>
                            @foreach($all_packages as $package)
                                <tr>
                                   {{--<td>{{$package->package_hash}}.</td>--}}
                                    <td>{{$package->Name}}<br><small>{{$package->Description}}</small></td>
                                    <td><span class="label label-warning">{{$package->Section}}</span></td>
                                    <td><span class="badge bg-green">@if($package->Downloads == null) 0 @else {{$package->Downloads}} @endif</span></td>
                                    <td>
                                        <a href="{{url('debs/'.$package->package_hash)}}" class="btn btn-xs btn-default" data-button-type="delete"><i class="fa fa-arrow-circle-down"></i></a>
                                        <a href="{{url('depiction/'.$package->package_hash)}}" class="btn btn-xs btn-default" data-button-type="info"><i class="fa fa-info-circle"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <li><a href="{{$pagination['prev_page_url']}}">&laquo;</a></li>
                            @for($i = 1; $i <= $pagination['last_page']; $i++)
                                <li @if($pagination['current_page'] == $i) class="active" @endif><a href="{{url($pagination['path'])}}?page={{$i}}">{{$i}}</a></li>
                            @endfor
                            <li><a href="{{$pagination['next_page_url']}}">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('after_scripts')
    <script type="text/javascript">

    </script>
@endsection