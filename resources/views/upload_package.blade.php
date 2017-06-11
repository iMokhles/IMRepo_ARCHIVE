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
    <link rel="stylesheet" href="{{ asset('css') }}/jquery.fileupload.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">{{ trans('backpack::base.login_status') }}</div>
                </div>

                <br>
                <div class="container">
                    <h2>Maximum upload file size is <strong>{{ini_get("upload_max_filesize")}}B</strong></h2>
                    <!-- The fileinput-button span is used to style the file input field as button -->
                    <span class="btn btn-success fileinput-button">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Upload Debs...</span>
                                        <!-- The file input field used as target for the file upload widget -->
                        <form id="fileupload">
                            <input id="filew" type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input name="files[]" multiple="" type="file">
                        </form>
                    </span>
                    <br>
                    <br>
                    <!-- The global progress bar -->
                    <div id="progress" class="progress" style="width: 50%">
                        <div class="progress-bar progress-bar-success"></div>
                    </div>
                    <!-- The container for the uploaded files -->
                    <div id="files" class="files"></div>
                    <br>
                </div>
        </div>
    </div>
@endsection

@section('after_scripts')
    <script src="{{ asset('js') }}/vendor/jquery.ui.widget.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="{{ asset('js') }}/jquery.iframe-transport.js"></script>
    <!-- The basic File Upload plugin -->
    <script src="{{ asset('js') }}/jquery.fileupload.js"></script>
    <script>

        $(function () {
            'use strict';
            // Change this to the location of your server-side upload handler:
            var url = 'upload_package',
                uploadButton = $('<button/>')
                    .addClass('btn btn-primary')
                    .prop('disabled', true)
                    .text('Processing...')
                    .on('click', function () {
                        var $this = $(this),
                            data = $this.data();
                        $this
                            .off('click')
                            .text('Abort')
                            .on('click', function () {
                                $this.remove();
                                data.abort();
                            });
                        data.submit().always(function () {
                            $this.remove();
                        });
                    });
            $('#fileupload').fileupload({
                url: url,
                dataType: 'json',
                autoUpload: true,
                maxFileSize: 999000,
                previewCrop: false
            }).on('fileuploadadd', function (e, data) {
                data.context = $('<div/>').appendTo('#files');
                $.each(data.files, function (index, file) {
                    var node = $('<p/>')
                        .append($('<span/>').text(file.name));
                    if (!index) {
                        node
                            .append('<br>')
                            .append(uploadButton.clone(true).data(data));
                    }
                    node.appendTo(data.context);
                });
            }).on('fileuploadprocessalways', function (e, data) {
                var index = data.index,
                    file = data.files[index],
                    node = $(data.context.children()[index]);
                if (file.preview) {
                    node
                        .prepend('<br>')
                        .prepend(file.preview)
                        .append('<br> '+formatFileSize(file.size));
                }
                if (file.error) {
                    node
                        .append('<br>')
                        .append($('<span class="text-danger"/>').text(file.error));
                }
                if (index + 1 === data.files.length) {
                    data.context.find('button')
                        .text('Upload')
                        .prop('disabled', !!data.files.error);
                }
            }).on('fileuploadprogressall', function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css(
                    'width',
                    progress + '%'
                );
            }).on('fileuploaddone', function (e, data) {
                $.each(data.result.files, function (index, file) {
                    if (file.url) {
                        /*                    var link = $('<a>')
                         .attr('target', '_blank')
                         .prop('href', file.url);
                         $(data.context.children()[index])
                         .wrap(link);*/
                        var links = $('<button type="button">')
                            .attr('onclick', 'lank()')
                            .attr('href', file.url);
                        $(data.context.children()[index])
                            .wrap(links);
                    } else if (file.error) {
                        var error = $('<span class="text-danger"/>').text(file.error);
                        $(data.context.children()[index])
                            .append('<br>')
                            .append(error);
                    }
                });
            }).on('fileuploadfail', function (e, data) {
                $.each(data.files, function (index) {
                    var error = $('<span class="text-danger"/>').text('File upload failed.');
                    $(data.context.children()[index])
                        .append('<br>')
                        .append(error);
                });
            }).prop('disabled', !$.support.fileInput)
                .parent().addClass($.support.fileInput ? undefined : 'disabled');
        });

    </script>
@endsection