@extends('default')
@section('css')
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
@stop
@section('js')
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
@stop
@section('content')
    @include('_errors')
    <ol class="breadcrumb">
        <li><a href="">Home</a></li>
        <li><a href="{{ route('admins.index') }}">Admin</a></li>
        <li>Show</li>
    </ol>
    <div class="jumbotron">
        <form action="{{ route("editInfo",[$admin]) }}" method="post">
        <p>用户名：<span class="name">{{ $admin->name }}</span></p>
        <p>邮　箱：<span class="email">{{ $admin->email }}</span></p>
        <p>头　像：</p>
        <p><span class="icon"></span><img src="{{ $admin->icon }}" id="img" class="img-thumbnail" width="200"></p>
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
        <p class="submit">
            <button class="btn btn-info" id="btn1">修改个人资料</button>
        </p>
        </form>
    </div>
    <script>
        $("#btn1").click(function () {
            $(".name").html('<input type="text" name="name" placeholder="用户名" value="{{ auth()->user()->name }}">');
            $(".icon").html('<input type="hidden" id="img_url" name="icon">\
            <div id="uploader-demo">\
            <!--用来存放item-->\
            <div id="fileList" class="uploader-list"></div>\
            <div id="filePicker">选择图片</div>\
            </div>\
            ');
            $(".submit").html('<button class="btn btn-info" type="submit">修改</button>')

            // 初始化Web Uploader
            var uploader = WebUploader.create({

                // 选完文件后，是否自动上传。
                auto: true,

                // swf文件路径
                //swf: BASE_URL + '/js/Uploader.swf',

                // 文件接收服务端。
                server: "{{ route('upload') }}",

                // 选择文件的按钮。可选。
                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                pick: '#filePicker',

                // 只允许选择图片文件。
                accept: {
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,bmp,png',
                    mimeTypes: 'image/gif,image/jpg,image/jpeg,image/bmp,image/png'
                },
                formData: {
                    _token: "{{ csrf_token() }}"
                }
            });
            uploader.on( 'uploadSuccess', function( file,response) {

                $('#img').attr({'src':response.fileName,'width':'180'});
                $('#img_url').val(response.fileName);
            });

        });
    </script>

@endsection