@extends("default")
@section("content")
    <ol class="breadcrumb">
        <li>Nav</li>
    </ol>
    <h1 class="text-center">修改菜单</h1>
    @include('_errors')
<form class="form-horizontal" method="post" action="{{ route('navs.update',[$nav]) }}" enctype="multipart/form-data">
    <div class="form-group">
        <label class="control-label">菜单名</label>
            <input type="text" name="name" class="form-control" placeholder="菜单名" value="{{ $nav->name }}">
    </div>
    <div class="form-group">
        <label>上级菜单</label>
            <select class="form-control" name="pid">
                <option value="0">顶级菜单</option>
                @foreach($pids as $pid)
                    <option value="{{ $pid->id }}" {{ $nav->pid==$pid->id?'selected':'' }}>{{ $pid->name }}</option>
                @endforeach
            </select>
    </div>
    <div class="form-group">
        <label class="control-label">地址</label>
            <input type="text" name="url" class="form-control"  placeholder="地址" value="{{ $nav->url }}">
    </div>

    <div class="form-group">
        <label class="control-label">权限列表</label>
            <select class="form-control" name="permission_id">
                <option>请选择权限...</option>
                @foreach($permissions as $permission)
                    <option value="{{ $permission->id }}" {{ $nav->permission_id==$permission->id?'selected':'' }}>{{ $permission->name }}</option>
                @endforeach
            </select>
    </div>

    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    <div class="form-group">
         <button type="submit" class="btn btn-primary btn-lg btn-block">提交</button>
    </div>
</form>
@endsection