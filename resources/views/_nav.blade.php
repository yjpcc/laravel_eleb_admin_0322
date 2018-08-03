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
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          @auth
            <ul class="nav navbar-nav">
                {!! \App\Model\Nav::navHtml() !!}
                {{--@foreach(\App\Model\Nav::where('pid',0)->get() as $nav)--}}
                    {{--@can($nav->permission->name)--}}
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $nav->name }} <span class="caret"></span></a>--}}
                     {{--<ul class="dropdown-menu">--}}
                         {{--@foreach(\App\Model\Nav::where('pid',$nav->id)->get() as $row)--}}
                             {{--@can($row->permission->name)--}}
                        {{--<li><a href="{{ route( $row->url ) }}">{{ $row->name }}</a></li>--}}
                             {{--@endcan--}}
                         {{--@endforeach--}}
                     {{--</ul>--}}
                {{--</li>--}}
                {{--@endcan--}}
                {{--@endforeach--}}
            </ul>
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