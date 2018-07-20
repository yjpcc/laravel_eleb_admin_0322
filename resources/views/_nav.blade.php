<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">风起天澜</a>
            {{--<img src="icon.jpg" width="50" class="img-circle">--}}
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          @auth
            <ul class="nav navbar-nav">
                {{--<li><a href="{{ route('articles.index') }}">文章列表</a></li>--}}
                <li><a href=""><span class="glyphicon glyphicon-home"></span>主页 <span class="sr-only">(current)</span></a></li>
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="--}}
{{--glyphicon glyphicon-list-alt"></span> 商品管理 <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="">商品列表</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                <li><a href="{{ route('shops.index') }}">商家管理</a></li>
                <li><a href="{{ route('shopusers.index') }}">商户账号管理</a></li>
                <li><a href="{{ route('shopcategorys.index') }}">商家分类</a></li>
                <li><a href="{{ route('admins.index') }}">平台账号管理</a></li>
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="--}}
{{--glyphicon glyphicon-user"></span> 用户 <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="{{ route('users.index') }}">用户列表</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            </ul>
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" name="keywords" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
            </form>
            @endauth
            <ul class="nav navbar-nav navbar-right">
                @guest
                <li>
                    {{--<a href="javascript:;" data-toggle="modal" data-target="#loginModal">登录</a>--}}<a href="{{ route('login') }}">登录</a>
                </li>
                @endguest
                @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img class="img-circle" width="20" src="{{ auth()->user()->icon }}" alt="头像"> {{ auth()->user()->name }} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('admins.show',[auth()->user()]) }}">个人主页</a></li>
                        <li><a href="javascript:;" data-toggle="modal" data-target="#pwdModal">修改密码</a></li>
                        <li role="separator" class="divider"></li>
                        <li>
                            {{--<form action="{{ route('logout')}}" method="post">--}}
                                {{--{{ method_field('DELETE') }}--}}
                                {{--{{ csrf_field() }}--}}
                                {{--<button class="btn-link" type="submit">注销</button>--}}
                            {{--</form>--}}
                            <a href="javascript:;" id="logout">注销</a>
                        </li>
                    </ul>
                </li>
                @endauth
            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>