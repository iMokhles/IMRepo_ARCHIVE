{{--/**--}}
 {{--* Created by PhpStorm.--}}
 {{--* User: imokhles--}}
 {{--* Date: 21/06/2017--}}
 {{--* Time: 20:05--}}
 {{--*/--}}
@extends('layouts.changelog')

@section('after_styles')
    <script src="https://use.fontawesome.com/f37af914d5.js"></script>
    <link rel="stylesheet" href="{{ asset('css/depiction.css') }}">
@endsection
@section('header_title')
    {{$Name}}
@endsection

@section('changelogs')
    @foreach($change_logs as $log)
        <section class="{{$log->package_version}}">
            <h2 role="header">{{$log->package_version}}</h2>
            <ul>
                {!! $log->changelog_text !!}
            </ul>
        </section>
    @endforeach
@endsection