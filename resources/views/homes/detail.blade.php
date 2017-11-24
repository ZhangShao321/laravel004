<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

        <title>个人资料</title>

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
                            <div class="nav-extra">
                                <i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
                                <i class="am-icon-angle-right" style="padding-left: 10px;"></i>
                            </div>
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

                        <!--头像 -->
                        <div class="user-infoPic">

                            <div class="filePic">
                                <input type="file" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*">
                                <img class="am-circle am-img-thumbnail" src="/homes/img/getAvatar.do.jpg" alt="" />
                            </div>

                            <p class="am-form-help">头像</p>

                            <div class="info-m">
                                <div><b>用户名：<i>小叮当</i></b></div>
                            </div>
                        </div>

                        <!--个人信息 -->
                        <div class="info-main">
                            <form class="am-form am-form-horizontal" action="{{url('/homes/doaction')}}"  method="post" enctype="multipart/form-data">

                                <div class="am-form-group">
                                    <label for="user-name2" class="am-form-label">昵称</label>
                                    <div class="am-form-content">
                                        <input type="text" id="user-name2" name="nickName" value="" placeholder="nickname">
                                          <small>昵称长度不能超过40个汉字</small>
                                    </div>
                                </div>


                                <div class="am-form-group">
                                    <label class="am-form-label">性别</label>
                                    <div class="am-form-content sex">
                                        <label class="am-radio-inline">
                                            <input type="radio" name="sex" value="male" data-am-ucheck> 男
                                        </label>
                                        <label class="am-radio-inline">
                                            <input type="radio" name="sex" value="female" data-am-ucheck> 女
                                        </label>
                                        <label class="am-radio-inline">
                                            <input type="radio" name="sex" value="secret" data-am-ucheck> 保密
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="am-form-group">
                                    <label for="user-email" class="am-form-label">电子邮件</label>
                                    <div class="am-form-content">
                                        <input id="user-email" placeholder="Email" type="email" name="email" value="">

                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-email" class="am-form-label">QQ</label>
                                    <div class="am-form-content">
                                        <input id="user-email" placeholder="QQ" type="text" name="qq" value="">

                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-email" class="am-form-label">上传头像</label>
                                    <div class="am-form-content">
                                        <input id="user-email" placeholder="file" type="file" name="photo" value="">

                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-phone" class="am-form-label">电话</label>
                                    <div class="am-form-content">
                                        <input id="user-phone" placeholder="telephonenumber" type="tel" name="phone" value="">

                                    </div>

                                </div>
                                {{ csrf_field() }}
                                <div class="info-btn">
                                     
                                    <button type="submit" id="sub" class="am-btn am-btn-danger">保存提交</button>
                                    

                                </div>

                            </form>
                        </div>

                    </div>

                </div>
                <!--底部-->
                <div class="footer">
                    <div class="footer-hd">
                        <p>
                            <a href="#">恒望科技</a>
                            <b>|</b>
                            <a href="#">商城首页</a>
                            <b>|</b>
                            <a href="#">支付宝</a>
                            <b>|</b>
                            <a href="#">物流</a>
                        </p>
                    </div>
                    <div class="footer-bd">
                        <p>
                            <a href="#">关于恒望</a>
                            <a href="#">合作伙伴</a>
                            <a href="#">联系我们</a>
                            <a href="#">网站地图</a>
                            <em>© 2015-2025 Hengwang.com 版权所有</em>
                        </p>
                    </div>
                </div>
            </div>

            <aside class="menu">
                <ul>
                    <li class="person active">
                        <a href="index.html"><i class="am-icon-user"></i>个人中心</a>
                    </li>
                    <li class="person">
                        <p><i class="am-icon-newspaper-o"></i>个人资料</p>
                        <ul>
                            <li> <a href="/homes/detail">个人信息</a></li>
                            <li> <a href="/homes/change">修改密码</a></li>
                            
                        </ul>
                    </li>
                    <li class="person">
                        <p><i class="am-icon-balance-scale"></i>我的交易</p>
                        <ul>
                            <li><a href="/homes/center">我的订单</a></li>
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