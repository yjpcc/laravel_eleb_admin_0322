@extends("default")
@section("content")
    <ol class="breadcrumb">
        <li>Nav</li>
    </ol>
    <h1 class="text-center">添加菜单</h1>
    @include('_errors')
<form class="form-horizontal" method="post" action="{{ route('navs.store') }}" enctype="multipart/form-data">
    <div class="form-group">
        <label class="control-label">菜单名</label>
            <input type="text" name="name" class="form-control" placeholder="菜单名" value="{{ old('name') }}">
    </div>
    <div class="form-group">
        <label>上级菜单</label>
            <select class="form-control" name="pid">
                <option value="0">顶级菜单</option>
                @foreach($navs as $nav)
                    <option value="{{ $nav->id }}">{{ $nav->name }}</option>
                @endforeach
            </select>
    </div>
    <div class="form-group">
        <label class="control-label">地址</label>
            <input type="text" name="url" class="form-control" id="inputTitle1" placeholder="地址" value="{{ old('url') }}">
    </div>

    <div class="form-group">
        <label class="control-label">权限列表</label>
            <select class="form-control" name="permission_id">
                <option value="0">请选择权限...</option>
                @foreach($permissions as $permission)
                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                @endforeach
            </select>
    </div>

    {{ csrf_field() }}
    <div class="form-group">
         <button type="submit" class="btn btn-primary btn-lg btn-block">提交</button>
    </div>
</form>
@endsection