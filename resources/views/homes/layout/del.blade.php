<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

        <title>@yield('title')</title>

        <link href="/homes/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
        <link href="/homes/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

        <link href="/homes/css/personal.css" rel="stylesheet" type="text/css">
        <link href="/homes/css/infstyle.css" rel="stylesheet" type="text/css">
        <script src="/homes/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
        <script src="/homes/AmazeUI-2.4.2/assets/js/amazeui.js"></script>           
    </head>

    <body>
        <!--头 -->
           
            <div class="nav-table">
                       <div class="long-title"><span class="all-goods">全部分类</span></div>
                       <div class="nav-cont">
                            <ul>
                                <li class="index"><a href="/homes/index">首页</a></li>
                                <li class="qc"><a href="/homes/filmlist">电影</a></li>
                                <li class="qc"><a href="/homes/cinemalist">电影院</a></li>
                            </ul>
                             
                        </div>
            </div>
            <b class="line"></b>
        <div class="center">
            <div class="col-main">
                <div class="main-wrap">

                    <div class="user-info">
                        <!--标题 -->
                        <div class="am-cf am-padding">
                            <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">个人资料</strong> / <small>Personal&nbsp;information</small></div>
                        </div>
                        <hr/>

                        <?php
                            $uid = session('uid');
                            $user = DB::table('user')->where('id',$uid)->first();
                            $re = DB::table('userDetail')->where('uid',$uid)->first();
                            
                        ?>

                        <!--头像 -->
                        <div class="user-infoPic">
                             
                            <div class="filePic">
                                <input type="file" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*">
                                <img class="am-circle am-img-thumbnail" src="http://ozspa9a4f.bkt.clouddn.com/Uplodes/{{$re->photo}}?imageView2/0/w/57/h/57" alt="" />
                            </div>

                            <p class="am-form-help">头像</p>
                            
                            @if(!$re->nickName)
                            <div class="info-m">
                                <div><b>用户名：<i>小叮当</i></b></div>
                            </div>
                            @else
                            <div class="info-m">
                                <div><b>用户名：<i>{{$re->nickName}}</i></b></div>
                            </div>
                            @endif

                        </div>

                        <!--个人信息 -->
                        <div class="info-main">
                            @if (session('msg'))
                                <div class="mws-form-message success">
                                    <ul>
                                        {{session('msg')}}
                                    </ul>
                                </div>
                            @endif       
                            
                            @section('content')

                            @show
                            
                            
                        </div>


                    </div>

                </div>
                <!--底部-->
                <div class="footer">
                    <div class="footer-hd">
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
                    <div class="footer-bd">
                        <p>
                            <p>
                                北京傻家伙网络科技有限公司Copyright 1937-2017 Mtime.com Inc. All rights reserved..
                            </p><p>
                            京ICP证888888号网络视听许可证888888888888号网络文化经营许可证广播电视节目制作经营许可证(京)字第1435号京公网安备：66666666666666号
                            </p>
                        </p>
                    </div>
                </div>
            </div>

            <aside class="menu">
                <ul>
                    <li class="person active">
                        <a href=""><i class="am-icon-user"></i>个人中心</a>
                    </li>
                    <li class="person">
                        <p><i class="am-icon-newspaper-o"></i>个人资料</p>
                        <ul>
                            <li> <a href="/homes/details">个人信息</a></li>
                            <li> <a href="/homes/change">修改密码</a></li>
                            <li> <a href="/homes/edit">修改头像</a></li>
                            
                        </ul>
                    </li>
                    <li class="person">
                        <p><i class="am-icon-balance-scale"></i>我的交易</p>
                        <ul>
                            <li><a href="/homes/center">我的订单</a></li>

                            <li><a href="/homes/center_w">未完成订单</a></li>

                            <li><a href="/homes/moneys">充值中心</a></li>
                            <li><a href="/homes/balance">我的余额</a></li>

                        </ul>
                    </li>
                    <li class="person">
                        <p><i class="am-icon-dollar"></i>电影</p>
                        <ul>
                            <li> <a href="/homes/filmlist">电影列表</a></li>
                        </ul>
                    </li>

                    <li class="person">
                        <p><i class="am-icon-tags"></i>电影院</p>
                        <ul>
                            <li> <a href="/homes/cinemalist">电影院列表</a></li>                                                       
                        </ul>
                    </li>

                    <li class="person">
                        <p><i class="am-icon-qq"></i>院线申请</p>
                        <ul>
                            <li> <a href="/homes/add">申请中心</a></li>
                             
                        </ul>
                    </li>
                </ul>

            </aside>
        </div>

    </body>

</html>