@if (Session::has('error'))
    <div class="alert alert-danger alert-dismissable alert-custom">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fa fa-ban"></i> {{ Session::get('error') }}</h5>
    </div>
@elseif (Session::has('success'))
    <div class="alert alert-success alert-dismissable alert-custom">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fa fa-check"></i> {{ Session::get('success') }}</h5>
    </div>
@endif