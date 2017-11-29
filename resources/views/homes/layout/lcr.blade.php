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
        <link href="{{asset('/homes/scss/dlstyle.css')}}" rel="stylesheet" type="text/css">
       
         

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
        <?php
            $ssss = DB::table('config')->first();
        ?>
        <div class="login-boxtitle">
            <a href="home/demo.html"><img alt="" src="{{asset('http://ozspa9a4f.bkt.clouddn.com/Uplodes/'. $ssss->logo) }}" /></a>
        </div>

        <div class="res-banner">
            <div class="res-main">
                <div style="margin-top:20px" class="login-banner-bg">
                    <img style="width:580px" src="{{asset('/homes/img/timg.jpg')}}" />
                </div>

          
                
                @section('content')
                @show

                </div>
        </div>

     
            
        <div class="footer ">
            <div class="footer-hd ">
            <?php
                $friend = DB::table('friendlink')->get();
            ?>
                <p>
                @foreach($friend as $kk=>$vv)
                    <a href="{{ $vv->url }}">{{$vv->linkname}}</a>
                    <b>|</b>
                    
                @endforeach
                </p>
            </div>
            <div class="footer-bd ">
                <p>
                    北京傻家伙网络科技有限公司Copyright 1937-2017 Mtime.com Inc. All rights reserved..
                </p><p>
                京ICP证888888号网络视听许可证888888888888号网络文化经营许可证广播电视节目制作经营许可证(京)字第1435号京公网安备：66666666666666号
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