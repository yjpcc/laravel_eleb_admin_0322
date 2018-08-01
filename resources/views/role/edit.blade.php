@extends("default")
@section("content")
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
    </ol>
    <h1 class="text-center">修改角色</h1>
    @include('_errors')
<form class="form-horizontal" method="post" action="{{ route('roles.update',[$role]) }}" enctype="multipart/form-data">
    <div class="form-group">
        <label for="inputTitle1" class="col-sm-2 control-label">角色名</label>
        <div class="col-sm-10">
            <input type="text" name="name" class="form-control" id="inputTitle1" placeholder="角色名" value="{{ $role->name }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">权限列表</label>
        <div class="col-sm-12">
            @foreach($permissions as $permission)
                <label class="col-xs-3 control-label">{{ $permission->name }}</label>
                <div class="col-xs-1">
                    <input type="checkbox" name="permission[]" value="{{ $permission->id }}" class="checkbox" {{ $myPermissions->contains($permission)?'checked':'' }}>
                </div>
            @endforeach
        </div>
    </div>

    {{ csrf_field() }}
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