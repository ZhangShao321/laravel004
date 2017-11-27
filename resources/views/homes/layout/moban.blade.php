<!doctype html>
<html class="no-js" lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>@yield('title')</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Place favicon.ico in the root directory -->
<link rel="shortcut icon" type="image/x-icon" href="/homes/img/favicon.ico">
<!-- google fonts -->
<link href='https://fonts.googleapis.com/css?family=Lato:400,900,700,300' rel='stylesheet'
	type='text/css'>
<!-- all css here -->
<!-- bootstrap v3.3.6 css -->
<link rel="stylesheet" href="/homes/css/bootstrap.min.css">
<!-- animate css -->
<link rel="stylesheet" href="/homes/css/animate.css">
<!-- jquery-ui.min css -->
<link rel="stylesheet" href="/homes/css/jquery-ui.min.css">
<!-- meanmenu css -->
<link rel="stylesheet" href="/homes/css/meanmenu.min.css">
<!-- RS slider css -->
<link rel="stylesheet" type="text/css" href="/homes/lib/rs-plugin/css/settings.css" media="screen" />
<!-- owl.carousel css -->
<link rel="stylesheet" href="/homes/css/owl.carousel.css">
<!-- font-awesome css -->
<link rel="stylesheet" href="/homes/css/font-awesome.min.css">
<!-- style css -->
<link rel="stylesheet" href="/homes/css/style.css">
<!-- responsive css -->
<link rel="stylesheet" href="/homes/css/responsive.css">

<link rel="stylesheet" href="/FilmAdmin/css/seat/jquery.seat-charts.css">

</head>
<body>
<!-- header-top-area start -->
<div  class="header-top-area hidden-xs">
    <div  class="container">
        <div class="row">
        <?php

            $con = DB::table('config')->first();
        ?>
            <div class="col-lg-6 col-md-6 col-sm-4">
                <div class="welcome">
                    <span class="phone">
                        Phone: +{{ $con->phone }}
                    </span>
                    <span class="hidden-sm">
                        /
                    </span>
                    <span class="email hidden-sm">
                        Email: {{$con->email}}
                    </span>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-8">
                <div class="top-menu">
                    <ul>
                        <h2 style="color:white">
                            
                        </h2>
                        <h2 ><marquee behavior="" style="color:red;font-family:'宋体'" direction="left"><i> 欢 迎 来 到 傻 家 伙 电 影 院 !!! </i></marquee></h2>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- header-top-area end -->


<div  class="sticky-wrapper">
	<header>
		<!-- 搜索栏，登陆注册 start -->			 
		<div style="background:#eee" class="header-bottom-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<div class="logo">
							<a href="{{url('/homes/index')}}"><img src="/homes/img/logo/logo3.jpg" alt="" /></a>
						</div>
					</div>
                    <form action="{{url('/homes/search')}}" method="get">
    					<div class="col-lg-6 col-md-5 col-sm-5 col-xs-6 hidden-xs">
    						<div class="header-search">
    							<input type="text" placeholder="请输入影片名..." name="seach" />
    							<button><i class="fa fa-search"></i></button>
    						</div>
    					</div>
                    </form>
					<div style="float:right" class="col-lg-3 col-md-4 col-sm-4 col-xs-12 float-right account-wrap">
						@if(!session('uid'))
                        <table>
                            <tr align="right">
                                <td>
                                    <a class="user_info_login" href="/homes/login" style="color:purple">
                                        <button class="btn btn-default btn-sm">登录</button>
                                    </a>&nbsp;&nbsp;&nbsp;
                                    <a class="user_info_reg" href="/homes/register" style="color:purple">
                                        <button class="btn btn-default btn-sm">注册</button>
                                    </a>&nbsp;&nbsp;&nbsp;
                                   
                                </td>

                                <td><a href=""><img src="/homes/img/default.jpg" style="width:57px;height:57px;float:right"></a></td>
                        
                            </tr>
                        </table>
                        @else
                        
                        <table>
                            <tr>
                                <td>欢迎来到{{ $con->webname }}!</td>
                                <?php
                                    $uid  = session('uid');
                                    $ures = DB::table('userDetail')->where('uid',$uid)->first();
                                ?>
                                    @if(!$ures->photo)
                                        <td rowspan="2"><a href=""><img src="/homes/img/default.jpg" style="width:57px;height:57px;float:right"></a></td>
                                    @else
                                        <td rowspan="2"><a href=""><img src="http://ozspa9a4f.bkt.clouddn.com/Uplodes/{{$ures->photo}}?imageView2/0/w/57/h/57 " style="width:57px;height:57px;float:right"></a></td>
                                    @endif    
                               
                            </tr>
                            <tr>
                                <td>
                                    
                                    <a class="user_info_reg" href="/homes/details" style="color:purple">
                                        <button class="btn btn-default btn-sm">个人中心</button>
                                    </a>&nbsp;&nbsp;&nbsp;
                                    <a class="user_info_reg" href="/homes/detail" style="color:purple">
                                        <button class="btn btn-default btn-sm">退出</button>
                                    </a>
                                </td>
                            </tr>
                        </table>

                        @endif
                   
					</div>
				</div>
			</div>
		</div>
		<!-- 搜索栏，登陆注册 end -->
	
		<!-- 导航条 start -->
        <div style="padding:0px" class="container"> 
		<div class="main-menu-area hidden-xs">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="main-menu">
							<nav>
								<ul>
									<li><a href="{{url('/homes/index')}}">首页</a></li>
									<li><a href="{{url('/homes/filmlist')}}">电影</a></li>
									<li><a href="{{url('/homes/cinemalist')}}">电影院</a></li>
									<li style="float:right">
                                        <h2 ><marquee behavior="" style="color:blue;font-family:'宋体'" direction="left"><i>让生活遇见电影，让电影融入生活！</i></marquee></h2>
                                    </li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div> 
        </div>
		<!-- 导航条 end -->         				
	</header>
</div>
<div class="container" style="background:#eee;padding:0px"> 
@section('content')
   


@show
</div>
<!-- footer start -->
<div style="padding:0px" class="container">
<footer>
    <div class="footer-top-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-4">
                    <div class="footer-widget">
                        <img src="/homes/img/logo/logo3.jpg" alt="" />
                        <p>
                            <h4 style="color:white">
                                傻家伙影视是一家成立了好多好多年的超清好多好多好多D的集好多好多种娱乐项目为一体的超超超超超超大型电影院
                            </h4>
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 hidden-sm">
                    <div class="footer-widget">
                        <h3>
                            如何在线选座购票
                        </h3>
                        <ul class="footer-menu">
                            <li>
                                <a href="#">
                                    选场次&选座位
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    在线支付
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    获取取票码
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    影院现场自助取票
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    送票热线:10086111
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4">
                    <div class="footer-widget">
                        <h3>
                            友情链接
                        </h3>
                        <?php 
                            $friend = DB::table('friendlink')->get();
                        ?>
                        <ul class="footer-menu">

                            @foreach($friend as $aa=>$bb)
                            <li>
                                <a href="{{ $bb->url }}">
                                    {{ $bb->linkname }}
                                </a>
                            </li>

                            @endforeach
                            
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4">
                    <div class="footer-widget">
                        <h3>
                            关于我们
                        </h3>
                        <ul class="footer-contact">
                            <li>
                                <i class="fa fa-map-marker">
                                </i>
                                地址:{{ $con->address }}
                            </li>
                            <li>
                                <i class="fa fa-envelope">
                                </i>
                                邮箱: {{ $con->email }}
                            </li>
                            <li>
                                <i class="fa fa-phone">
                                </i>
                                电话: +{{ $con->phone }}
                            </li>
                            <li>
                                <a href="{{url('/homes/add')}}" style="color:white">
                                    <i class="fa fa-plus">
                                    </i>
                                </a>
                                <a href="{{url('/homes/add')}}" style="color:white">
                                    申请商户
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-md-offset-2">
                    <div class="copyright">
                        <p>
                            北京傻家伙网络科技有限公司Copyright 1937-2017 Mtime.com Inc. All rights reserved..
                            京ICP证888888号网络视听许可证888888888888号网络文化经营许可证广播电视节目制作经营许可证(京)字第1435号京公网安备：66666666666666号
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
<!-- footer end -->


<!-- all js here -->
<!-- modernizr css -->
<script src="/homes/js/vendor/modernizr-2.8.3.min.js"></script>
<!-- jquery latest version -->
<script src="/homes/js/vendor/jquery-1.12.0.min.js"></script>
<!-- bootstrap js -->
<script src="/homes/js/bootstrap.min.js"></script>
<!-- owl.carousel js -->
<script src="/homes/js/owl.carousel.min.js"></script>
<!-- jquery-ui js -->
<script src="/homes/js/jquery-ui.min.js"></script>
<!-- RS-Plugin JS -->
<script type="text/javascript" src="/homes/lib/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="/homes/lib/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script src="/homes/lib/rs-plugin/rs.home.js"></script>
<!-- meanmenu js -->
<script src="/homes/js/jquery.meanmenu.js"></script>
<!-- wow js -->
<script src="/homes/js/wow.min.js"></script>
<!-- plugins js -->
<script src="/homes/js/plugins.js"></script>
<!-- main js -->
<script src="/homes/js/main.js"></script>
<!-- 表单验证js -->
<script src="/homes/js/validate/dist/jquery.validate.min.js"></script>
<!-- <script src="/homes/js/jquery.validate.messages_cn.js"></script> -->
<!-- 弹框js -->
<script type="text/javascript" src="{{asset('/homes/js/layer/layer.js')}}"></script>
<script type="text/javascript" src="{{asset('/homes/js/layer/extend/layer.ext.js')}}"></script>

<script type="text/javascript" src="/FilmAdmin/js/seat/jquery.seat-charts.min.js"></script>
@section('js')

@show
</body>
</html>

