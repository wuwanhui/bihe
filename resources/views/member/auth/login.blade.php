@extends('layouts.site')

@section('content')
    <div class="container">
        <div class="login-box-body">
            <p class="login-box-msg h4"><i class="icon-desktop"></i> 智慧旅游-管理平台</p>
            <form role="form" method="POST">
                {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <input id="email" name="email" type="email" class="form-control" placeholder="邮箱">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input id="password" name="password" type="password" class="form-control" placeholder="密码">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="checkbox ">
                            <label>
                                <input type="checkbox"> 记住我
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-6 text-right">
                        <button type="submit" class="btn btn-primary  ">登录</button>
                    </div>
                </div>
            </form>
            <div class="social-auth-links text-center">
                <p>- OR -</p>
                <a href="#">忘记密码</a>
                <a href="/manage/register"> 注册</a>
            </div>

        </div>
    </div>
@endsection