@extends("default")
@section("content")
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li>修改权限</li>
    </ol>
    <h1>修改权限</h1>
    @include('_errors')
<form class="form-horizontal" method="post" action="{{ route('permissions.update',[$permission]) }}" enctype="multipart/form-data">
    <div class="form-group">
        <label for="inputTitle1" class="col-sm-2 control-label">权限名</label>
        <div class="col-sm-10">
            <input type="text" name="name" class="form-control" id="inputTitle1" placeholder="权限名" value="{{ $permission->name }}">
        </div>
    </div>
    {{ csrf_field() }}
    {{ method_field("PATCH") }}
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary btn-lg btn-block">提交</button>
        </div>
    </div>
</form>
@endsection
@section('js_upload')
    @include('upload')
@stop