@extends("default")
@section("content")
    <ol class="breadcrumb">
        <li>添加分类</li>
    </ol>
    <h1>添加分类</h1>
    @include('_errors')
<form class="form-horizontal" method="post" action="{{ route('shopcategorys.store') }}" enctype="multipart/form-data">
    <div class="form-group">
        <label for="inputTitle1" class="col-sm-2 control-label">分类名</label>
        <div class="col-sm-10">
            <input type="text" name="name" class="form-control" id="inputTitle1" placeholder="分类名" value="{{ old('name') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">商品图片</label>
        <div class="col-sm-10">
            <input type="hidden" id="img_url" name="img">
            <div id="uploader-demo">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
            </div>
            <img id="img" alt="">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">是否显示</label>
        <div class="col-sm-10">
            <input type="checkbox" name="status" value="1" class="checkbox">
        </div>
    </div>

    {{ csrf_field() }}
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