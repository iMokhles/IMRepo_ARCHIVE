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
                            <form action="{{ url('admin/upload_package')}}" method="POST" class="dropzone" id="my-awesome-dropzone" enctype="multipart/form-data">
                                <div class="fallback">
                                    <input name="file[]" type="file" multiple />
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
            <script src="https://cdn.rawgit.com/jprichardson/string.js/master/dist/string.min.js"></script>
            <script src="{{ asset('dropzone') }}/dropzone.js"></script>

            <script>

                var global_files = [];
                var global_media = [];
                Dropzone.options.myAwesomeDropzone = {
                    maxFilesize: 30, // MB
                    maxFiles:25,
                    addRemoveLinks: true,
                    paramName: "file",
                    uploadMultiple: false,
                    dictResponseError: 'Server not Configured',
                    dictFileTooBig: 'Deb is bigger than 30MB',
                    dictDefaultMessage: '<strong style="font-size: 20px">Upload Debs</strong><br/><small class="muted" style="font-size: 20px">Select or Drag & Drop <br>Deb From Your Device</small>',
                    acceptedFiles: ".deb",
                    init: function () {
                        var self = this;
                        // config
                        self.options.addRemoveLinks = true;
                        self.options.dictRemoveFile = "Delete";
                        //New file added
                        self.on("addedfile", function (file) {
                            //   global_files.push(file);
                            // console.log('new file added ', file);
                        });
                        // Send file starts
                        self.on("sending", function (file) {
                            console.log('upload started', file);
                            $('.meter').show();
                        });
                        // File upload Progress
                        self.on("totaluploadprogress", function (progress) {
                            console.log("progress ", progress);
                            $('.roller').width(progress + '%');
                        });
                        self.on("queuecomplete", function (progress) {
                            $('.meter').delay(999).slideUp(999);
                        });
                        // On removing file
                        self.on("removedfile", function (file) {
                            //find index of
                            let leng = global_files.length;
                            let index = -1;
                            for (var i = 0; i < leng; i++) {
                                if (JSON.stringify(global_files[i]) === JSON.stringify(file)) {
                                    index = i;
                                    break;
                                }
                            }
                            if (index > -1) {
                                global_files.splice(index, 1);
                                global_media.splice(index, 1);
                            }
                        });
                        self.on("success", function (file, response) {
                            global_files.push(file);
                            global_media.push(response.data);
                            console.log('=========>data', response);
                        });

                        self.on("error", function (file, response) {
//                            global_files.push(file);
//                            global_media.push(response.data);
                            console.log('=========>Error', response);
                        });
                    }
                };
            </script>
@endsection