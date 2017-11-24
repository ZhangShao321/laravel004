<!DOCTYPE html>
<html>
            

    <head lang="en">
        <meta charset="UTF-8">

        <title>@yield('title')</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <meta name="renderer" content="webkit">
        <meta http-equiv="Cache-Control" content="no-siteapp" />


        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="/homes/AmazeUI-2.4.2/assets/css/amazeui.min.css" />
        <link href="/homes/scss/dlstyle.css" rel="stylesheet" type="text/css">
       
         
        <script src="/homes/js/layer/jquery-1.8.3.min.js"></script>
        <script src="/homes/js/validate.js"></script>
        <script src="/homes/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
        <script src="/homes/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>
        <script type="text/javascript" src="{{asset('/homes/jss/jquery.js')}}"></script>
            <script type="text/javascript" src="{{asset('/homes/js/layer/layer.js')}}"></script>
            <script type="text/javascript" src="{{asset('/homes/js/layer/extend/layer.ext.js')}}"></script>
        <style type="text/css">
            .yanzheng{
                color: red;
                font-size:12px;
            }
        </style>

    </head>

    <body>

        <div class="login-boxtitle">
            <a href="home/demo.html"><img alt="" src="/homes/img/logobig.png" /></a>
        </div>

        <div class="res-banner">
            <div class="res-main">
                <div class="login-banner-bg">
                    <img src="/homes/img/big.jpg" />
                </div>

          
                
                @section('content')
                @show

                </div>
        </div>
            
        <div class="footer ">
            <div class="footer-hd ">
                <p>
                    <a href="# ">恒望科技</a>
                    <b>|</b>
                    <a href="# ">商城首页</a>
                    <b>|</b>
                    <a href="# ">支付宝</a>
                    <b>|</b>
                    <a href="# ">物流</a>
                </p>
            </div>
            <div class="footer-bd ">
                <p>
                    <a href="# ">关于恒望</a>
                    <a href="# ">合作伙伴</a>
                    <a href="# ">联系我们</a>
                    <a href="# ">网站地图</a>
                    <em>© 2015-2025 Hengwang.com 版权所有</em>
                </p>
            </div>
        </div>

        <script type="text/javascript">
            // alert($);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });



         </script>
    
        @section('js')

            
        @show
    </body>

</html>