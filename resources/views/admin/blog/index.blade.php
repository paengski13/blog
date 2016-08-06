@extends('layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @include('layouts.message')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-list" aria-hidden="true"></i>&nbsp;List Blog
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
                            <button type="button" id="createBtn" class="btn btn-info" data-toggle="tooltip" title="Create Blog">
                                <i class="fa fa-plus"></i></button>
                        </div>
                        <!-- /. tools -->
                    </div> <br/>

                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Created At</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            @foreach($blogs as $blog)
                            <tr>
                                <td><a href="{{ route('admin.blog.edit', $blog->id) }}">{{ $blog->title }}</a></td>
                                <th>{{ $blog->user->name }}</th>
                                <th>{{ $blog->created_at->format('M d, Y') }}</th>
                                <td>
                                    @if ($blog->status == 'published')
                                    <span class="badge bg-aqua">Published</span>
                                    @else
                                        <span class="badge">Saved</span>
                                    @endif
                                </td>
                                <th><button type="button" id="deletehBtn" onclick="deleteId('{{ $blog->id }}')" class="btn btn-danger btn-sm"
                                            data-toggle="modal" data-target="#deleteModal" title="Delete">
                                        <i class="fa fa-trash"></i></button></th>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col-->
        </div>
        <!-- ./row -->
    </section>
    <!-- /.content -->
</div><!-- /.content-wrapper -->


<!-- Delete modal -->
<div id="deleteModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete</h4>
            </div>
            <div class="modal-body">
                Are you sure you want this record?
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{ route('admin.blog.destroy', 1) }}" id="formDelete" accept-charset="UTF-8">
                    <button type="button" name="btnDeleteModalCancel" class="btn btn-default" data-dismiss="modal">
                        <i class="fa fa-close"></i> Cancel</button>
                    <button type="button" name="btnDeleteModal" id="btnDeleteModal" class="btn btn-danger">
                        <i class="fa fa-close"></i> Delete</button>
                    <input type="hidden" id="id" name="id" value=""/>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('inlineScripts')
    <script>
        $(document).ready(function () {
            $("#btnDeleteModal").click(function () {
                // check if at least 1 id has been selected
                var id = $("input[name=id]").val();
                if (id) {
                    $.ajax({
                        method: "post",
                        url: '{{ route('admin.blog.destroy', '') }}/' + id,
                        data: {"_method": 'delete', "_token": "{{ csrf_token() }}" }
                    }).done(function (obj) {
                        window.location.href = '{{ route("admin.blog.index") }}';
                    });
                }
            });

            $("#createBtn").click(function () {
                window.location = '{{ route("admin.blog.create") }}';
            });
        });

        function deleteId(id) {
            $("#formDelete").attr("action", "{{ route('admin.blog.destroy', '') }}/" + id);
            $("input[name=id]").val(id);
        }
    </script>
@endsection


