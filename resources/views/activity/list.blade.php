<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>laravel</title>
    <style>
    </style>
    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
@yield('css')
<!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
    <script src="/js/jquery-3.2.1.min.js"></script>
    <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
    <script src="/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container" style="margin-top: 50px">
<table class="table table-striped table-hover table-bordered table-condensed">
        <tr>
            <th>ID</th>
            <th>活动名称</th>
            <th>活动开始时间</th>
            <th>活动结束时间</th>
            <th>操作</th>
        </tr>
        @foreach ($activitys as $activity)
            <tr>
                <td>{{ $activity->id }}</td>
                <td>{{ $activity->title }}</td>
                <td>{{ $activity->start_time }}</td>
                <td>{{ $activity->end_time }}</td>
                <td>
                    <a class="btn btn-success" href="http://admin.eleb.com/html/{{$activity->id}}.html" title="查看"><span class="glyphicon glyphicon-eye-open"></span></a>
                   </td>
            </tr>
        @endforeach
    <tr>
        <td colspan="6"><a href="http://shop.eleb.com/activitys" class="btn btn-info btn-block">更多活动</a></td>
    </tr>
    </table>
</div>
</body>
</html>