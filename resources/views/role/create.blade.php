@extends("default")
@section("content")
    <ol class="breadcrumb">
        <li>Role</li>
    </ol>
    <h1 class="text-center">添加角色</h1>
    @include('_errors')
<form class="form-horizontal" method="post" action="{{ route('roles.store') }}" enctype="multipart/form-data">
    <div class="form-group">
        <label for="inputTitle1" class="col-sm-1 control-label">角色名</label>
        <div class="col-sm-11">
            <input type="text" name="name" class="form-control" id="inputTitle1" placeholder="角色名" value="{{ old('name') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-1 control-label">权限列表</label>
        <div class="col-sm-11">
            @foreach($permissions as $permission)
            <label><input type="checkbox" name="permission[]" value="{{ $permission->id }}">
                <span style="margin-right: 10px">{{ $permission->name }}</span>
            </label>
            @endforeach
        </div>
    </div>

    {{ csrf_field() }}
    <div class="form-group">
        <div class="col-sm-offset-1 col-sm-11">
            <button type="submit" class="btn btn-primary btn-lg btn-block">提交</button>
        </div>
    </div>
</form>
@endsection