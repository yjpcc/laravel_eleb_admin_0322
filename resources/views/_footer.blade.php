
{{--@guest--}}
{{--<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">--}}
    {{--<div class="modal-dialog modal-xs" role="document">--}}
        {{--<div class="modal-content">--}}
            {{--<div class="modal-header">--}}
                {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>--}}
                {{--<h2 class="modal-title" id="myModalLabel" style="text-align: center">用户名密码登录</h2>--}}
            {{--</div>--}}
            {{--<div class="modal-body">--}}
                {{--<form action="{{ route('login') }}" method="post">--}}
                    {{--<div class="form-group">--}}
                        {{--<input type="text" name="name" class="form-control" placeholder="手机/邮箱/用户名" value="{{ old('name') }}">--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<input type="password" name="password" class="form-control" placeholder="密码">--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-xs-6"><input id="captcha" class="form-control"  name="captcha"  placeholder="请输入验证码"></div>--}}
                            {{--<div class="col-xs-6"><img class="thumbnail captcha"  src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码"></div>--}}
                        {{--</div>--}}
                    {{--</div>--}}


                    {{--<div class="checkbox">--}}
                        {{--<label>--}}
                            {{--<input type="checkbox" name="remember" value="1">下次自动登录--}}
                        {{--</label>--}}
                    {{--</div>--}}
                    {{--{{ csrf_field() }}--}}
                    {{--<button class="btn btn-info btn-block" type="submit">登录</button>--}}
                {{--</form>--}}
            {{--</div>--}}

            {{--<div class="modal-footer">--}}
                {{--<a href="" style="float: left">扫码登录 <span class="glyphicon glyphicon-qrcode"></span></a>--}}
                {{--<a href="">立即注册</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
{{--@endguest--}}


@auth

<div class="modal fade" id="pwdModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style="text-align: center">修改个人密码</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('editPwd',[auth()->user()]) }}" method="post">
                    <div class="form-group">
                        <input type="password" name="oldpassword" class="form-control" placeholder="旧密码">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="新密码">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="确认密码">
                    </div>
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <button class="btn btn-info btn-block">修改</button>
                </form>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#logout").click(function () {
        $.ajax({
            url:"{{ route('logout') }}",
            type:"DELETE",
            dataType:"json",
            success:function(e){
                location.href="{{ route('admins.index') }}";
            }
        });
    })
</script>
@endauth
@yield('js_upload')
</body>
</html>