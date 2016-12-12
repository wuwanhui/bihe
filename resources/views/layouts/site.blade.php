<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{Base::config('name')}}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/site.css" rel="stylesheet">

    <script src="/js/app.js"></script>
    <script src="/js/common.js"></script>
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div id="app">
    <div class="container-fluid">
        <div class="header">
            <div class="header_nav">
                <div class="container">
                    <div class="row ">
                        <div class="col-sm-4 text-left "><span class="nav_text"> 币合财富、你身边的理财专家</span></div>
                        <div class="col-sm-8 text-right"><a
                                    href="/member/pay" class="active">充值/提现</a> | <a href="/member/register">注册</a> | <a
                                    href="/member/login">登录</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header_logo">
                <div class="container">
                    <div class="row ">
                        <div class="col-sm-4 text-left "><a> <img src="/images/logo.png" class="logo"></a></div>
                        <div class="col-sm-8 text-right"><a> <img src="/images/tel.png" class="tel"></a></div>
                    </div>
                </div>
            </div>
            <div class="header_menu">
                <div class="container">
                    @foreach(Base::menu() as $item)
                        <a href="{{$item->url}}">{{$item->name}}</a>
                    @endforeach
                    <a href="#">外盘业务</a>
                    <a href="#">资金撮合</a>
                    <a href="#">关于币合</a>
                    <a href="#">相关下载</a>
                    <a href="#">新闻公告</a>

                </div>
            </div>
        </div>
        <div class="content">
            @yield('content')
        </div>
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-12">
                    </div>
                    <div class="col-sm-4">
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@yield('script')
</body>
</html>
