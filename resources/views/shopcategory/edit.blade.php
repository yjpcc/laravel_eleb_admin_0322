@extends("default")
@section("content")
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li><a href="{{ route('shopcategorys.index') }}">Shop_Category</a></li>
        <li>Shop_Category_Edit</li>
    </ol>
    <h1>修改分类</h1>
    @include('_errors')
<form class="form-horizontal" method="post" action="{{ route('shopcategorys.update',[$shopcategory]) }}" enctype="multipart/form-data">
    <div class="form-group">
        <label for="inputTitle1" class="col-sm-2 control-label">分类名</label>
        <div class="col-sm-10">
            <input type="text" name="name" class="form-control" id="inputTitle1" placeholder="分类名" value="{{ $shopcategory->name }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">商品图片</label>
        <div class="col-sm-10">
            <input type="file" name="img">
            <img class="thumbnail img-responsive" src="{{ $shopcategory->img }}" width="200" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">是否显示</label>
        <div class="col-sm-10">
            <input type="checkbox" name="status" value="1" class="checkbox" {{ $shopcategory->status?'checked':'' }}>
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
