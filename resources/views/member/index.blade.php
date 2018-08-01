@extends('default')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <ol class="breadcrumb">
                <li><a href="">Home</a></li>
                <li>Member</li>
            </ol>
        </div>
        <div class="col-lg-4">
            <form action="{{ route('members.index') }}" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" name="keywords" placeholder="会员名" value="{{ $keywords }}">
                    <span class="input-group-btn">
        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                </span>
                </div><!-- /input-group -->
            </form>
        </div><!-- /.col-lg-6 -->
    </div>
    @include('_errors')
    <table class="table table-striped table-hover table-bordered table-condensed">
        <tr>
            <th>ID</th>
            <th>会员头像</th>
            <th>会员名</th>
            <th>电话号码</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach ($members as $member)
            <tr>
                <td>{{ $member->id }}</td>
                <td><img class="img-circle" src="{{ $member->members_img }}" width="80"></td>
                <td>{{ $member->username }}</td>
                <td>{{ $member->tel }}</td>
                <td>
                    <a href="{{ route('checkMember',[$member]) }}" class="btn-sm {{ $member->status?'btn-success':'btn-danger' }}">{{ $member->status?'正常':'禁用' }}</a>
                </td>
                <td>
                    @can('member-show')
                    <a class="btn btn-success" href="{{ route('members.show',[$member]) }}" title="查看"><span class="glyphicon glyphicon-eye-open"></span></a>
                    @endcan
                    @can('member-edit')
                    <a class="btn btn-warning" href="{{ route('members.edit',[$member]) }}" title="编辑"><span class="glyphicon glyphicon-pencil"></span></a>
                    @endcan
                    @can('member-del')
                            <form action="{{ route('members.destroy',[$member]) }}" method="post" style="display: inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                    @endcan
                </td>
            </tr>
        @endforeach
        @can('member-create')
        <tr>
            <td colspan="8">
                <a href="{{ route('members.create') }}" class="btn btn-success btn-block">添加</a>
            </td>
        </tr>
         @endcan
    </table>
    {{ $members->appends(['keywords'=>$keywords])->links() }}
@endsection