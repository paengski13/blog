@extends('layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @include('layouts.message')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;Update Blog
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Blog</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title"></h3>

                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button type="button" id="publishBtn" class="btn btn-info" data-toggle="tooltip" title="Publish">
                                <i class="fa fa-send"></i></button>
                            @if ($blog->status != 'published')
                            <button type="button" id="saveBtn" class="btn btn-info" data-toggle="tooltip" title="Save as draft">
                                <i class="fa fa-save"></i></button>
                            @endif
                            <button type="button" id="backBtn" class="btn btn-info" data-toggle="tooltip" title="Cancel">
                                <i class="fa fa-arrow-left"></i></button>
                        </div>
                        <!-- /. tools -->
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body pad">
                        <form method="POST" action="{{ route('admin.blog.update', $blog->id) }}" id="formAdd" accept-charset="UTF-8">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="action" value="draft">

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-book"></i>
                                    </div>
                                    <input type="text" name="title" value="{{ (old('title') ? old('title') : $blog->title) }}" class="form-control" placeholder="Title">
                                </div>
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                            <textarea id="body" name="body" rows="10" cols="80">{{ (old('body') ? old('body') : $blog->body) }}</textarea>
                                @if ($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col-->
        </div>
        <!-- ./row -->
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->
@endsection

@section('inlineScripts')
    <script>
        $(document).ready(function () {
            $("#publishBtn").click(function () {
                $("input[name=action]").val('published');

                $("#formAdd").submit();
            });

            $("#saveBtn").click(function () {
                $("input[name=action]").val('saved');
                $("#formAdd").submit();
            });

            $("#backBtn").click(function () {
                window.location = '{{ route("admin.blog.index") }}';
            });
        });

        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('body');
            //bootstrap WYSIHTML5 - text editor
            $(".textarea").wysihtml5();
        });
    </script>
@endsection


