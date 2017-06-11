{{--/**--}}
 {{--* Created by PhpStorm.--}}
 {{--* User: imokhles--}}
 {{--* Date: 09/06/2017--}}
 {{--* Time: 14:23--}}
 {{--*/--}}

@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            {{ trans('backpack::base.dashboard') }}<small>Upload Packages</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="active">Upload Packages</li>
        </ol>
    </section>
@endsection

@section('after_styles')
{{--    <link rel="stylesheet" href="{{ asset('css') }}/style.css">--}}
    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="{{ asset('dropzone') }}/dropzone.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">Debs File Uploader</div>
                </div>
                <div class="container">
                    @if($files_uploaded == null)
                        <h3>Maximum upload file size is <strong>{{ini_get("upload_max_filesize")}}B</strong></h3>
                        <center>
                            <form action="{{ url('admin/upload_package')}}" method="post" class="dropzone" id="my-awesome-dropzone" enctype="multipart/form-data">
                                <div class="fallback">
                                    <input name="file" type="file" multiple />
                                    <input name="hidden" type="_token" value='{{ csrf_token() }}'/>
                                </div>
                                {{ csrf_field() }}
                            </form>
                        </center>
                    @endif


                </div>
            </div>
        </div>
    </div>
@endsection

@section('after_scripts')
            <script src="https://cdn.rawgit.com/jprichardson/string.js/master/lib/string.min.js"></script>
            <script src="{{ asset('dropzone') }}/dropzone.js"></script>

            <script>
                Dropzone.options.myAwesomeDropzone = {
                    paramName: "file", // The name that will be used to transfer the file
                    maxFilesize: 30, // MB
                    maxFiles: 5,
                    uploadMultiple: true,
                    addRemoveLinks: true,
                    dictResponseError: 'Server not Configured',
                    dictDefaultMessage: '<strong style="font-size: 20px">Upload Debs</strong><br/><small class="muted" style="font-size: 20px">Select or Drag & Drop <br>Deb From Your Device</small>',
                    acceptedFiles: ".deb"
                };
            </script>
@endsection