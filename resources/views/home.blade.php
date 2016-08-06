@extends('layouts.master')

@section('content')
        <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @include('layouts.message')
            <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-book" aria-hidden="true"></i>&nbsp;Blog
        </h1>
        <ol class="breadcrumb">
            <li><a class="active"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        @foreach ($users as $user)
            @if ($user->blogs->count())
                <div class="row">
                    <div class="col-md-3">
                        <!-- Profile Image -->
                        <div class="box box-primary">
                            <div class="box-body box-profile">
                                <img class="profile-user-img img-responsive img-circle" src="{{ asset("/bower_components/AdminLTE/dist/img/rafael.jpg") }}" alt="User profile picture">

                                <h3 class="profile-username text-center">{{ $user->name }}</h3>

                                <ul class="list-group list-group-unbordered">

                                </ul>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                        <!-- /.col -->

                    <div class="col-md-9">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#activity" data-toggle="tab">Post</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    @foreach($user->blogs as $blog)
                                    <!-- Post -->
                                    <div class="post">
                                        <div class="user-block">
                                            <span class="username">
                                              <a >{!! $blog->title !!}</a>
                                            </span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p>
                                            {!! $blog->body !!}
                                        </p>
                                    </div>
                                    <!-- /.post -->
                                    @endforeach
                                </div>
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            @endif
        @endforeach

    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->
@endsection

@section('inlineScripts')
    <script>
    </script>
@endsection