<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
<head>
<meta charset="utf-8">

<!-- Viewport Metatag -->
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<!-- Plugin Stylesheets first to ease overrides -->
<link rel="stylesheet" type="text/css" href="/admins/plugins/colorpicker/colorpicker.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admins/custom-plugins/wizard/wizard.css" media="screen">

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="/admins/bootstrap/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admins/css/fonts/ptsans/stylesheet.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admins/css/fonts/icomoon/style.css" media="screen">

<link rel="stylesheet" type="text/css" href="/admins/css/mws-style.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admins/css/icons/icol16.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admins/css/icons/icol32.css" media="screen">

<!-- Demo Stylesheet -->
<link rel="stylesheet" type="text/css" href="/admins/css/demo.css" media="screen">

<!-- jQuery-UI Stylesheet -->
<link rel="stylesheet" type="text/css" href="/admins/jui/css/jquery.ui.all.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admins/jui/jquery-ui.custom.css" media="screen">

<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css" href="/admins/css/mws-theme.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admins/css/themer.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admins/css/styles.css" media="screen">


<title>@yield('title')</title>

</head>

<body>
    <!-- Header -->
    <div id="mws-header" class="clearfix">
    
        <!-- Logo Container -->
        <div id="mws-logo-container">
        
            <!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
            <div id="mws-logo-wrap">
                <h2 style='color:white'>后台管理</h2>
            </div>
        </div>
        
        <!-- User Tools (notifications, logout, profile, change password) -->
        <div id="mws-user-tools" class="clearfix">
                    
            <!-- User Information and functions section -->
            <div id="mws-user-info" class="mws-inset">                
                <?php
                    $uid = session('aid');

                    $datas = DB::table('userDetail')->where('uid',$uid)->first();
                ?>
                <!-- User Photo -->
                <div id="mws-user-photo">
                    <!-- <img src="{{ $datas->photo }}" alt="User Photo"> -->
                    <img style="width:30px;height:30px" src="http://ozspa9a4f.bkt.clouddn.com/Uplodes/{{$datas->photo}}?imageView2/0/w/240/h/240" alt="User Photo">
                </div>

                <!-- Username and Functions -->
                <div id="mws-user-functions">
                    
            
                    <div id="mws-username">
                        Hello,{{ $datas->nickName }}


                    </div>
                    <ul>
                        <li><a href="/admin/guanli/photo">修改头像</a></li>
                        <li><a href="/admin/guanli/pass">修改密码</a></li>


                        <li><a href="/admin/outlogin">退出</a></li>

                      
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Start Main Wrapper -->
    <div id="mws-wrapper">
    
        <!-- Necessary markup, do not remove -->
        <div id="mws-sidebar-stitch"></div>
        <div id="mws-sidebar-bg"></div>
        
        <!-- Sidebar Wrapper -->
        <div id="mws-sidebar">
        
            <!-- Hidden Nav Collapse Button -->
            <div id="mws-nav-collapse">
                <span></span>
                <span></span>
                <span></span>
            </div>
            
            <!-- Searchbox -->
            <div id="mws-searchbox" class="mws-inset">
                <form action="typography.html">
                    <input type="text" class="mws-search-input" placeholder="Search...">
                    <button type="submit" class="mws-search-submit"><i class="icon-search"></i></button>
                </form>
            </div>
            
            <!-- Main Navigation -->
            <div id="mws-navigation">

                <ul>
                    
                    <li>
                        <a href="#"><i class="icon-users" ></i>用户管理</a>
                        <ul class='closed'>
                            <li><a href="/admin/user/create">用户添加</a></li>
                            <li><a href="/admin/user">用户列表</a></li>
                        </ul>
                    </li>


                     <li>

                        <a href="#"><i class="icon-add-contact" ></i>管理员管理</a>
                        <ul class='closed'>
                            <li><a href="/admin/guanliyuan/create">管理员添加</a></li>
                            <li><a href="/admin/guanliyuan">管理员列表</a></li>
                        </ul>
                    </li>
                   
                    <li>
                        <a href="#"><i class="icon-film-camera" ></i>商户管理</a>
                        <ul class='closed'>

                            <li><a href="/admin/cinema/create">商户添加</a></li>
                            <li><a href="/admin/cinema">商户列表</a></li>

                        </ul>
                    </li>

                     <li>
                        <a href="#"><i class="icon-plus" ></i>申请管理</a>
                        <ul class='closed'>                         

                            <li><a href="/admin/request">申请列表</a></li>

                        </ul>
                    </li>

                     <li>
                        <a href="#"><i class="icon-film" ></i>影视分类</a>
                        <ul class='closed'>
                            <li><a href="/admin/film/create">添加分类</a></li>
                            <li><a href="/admin/film">影视分类列表</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="icon-pictures" ></i>轮播图管理</a>
                        <ul class='closed'>
                            <li><a href="/admin/lunbo/create">添加轮播图</a></li>
                            <li><a href="/admin/lunbo">轮播图列表</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="icon-align-justify" ></i>友情链接</a>
                        <ul class='closed'>
                            <li><a href="/admin/block/create">添加友情链接</a></li>
                            <li><a href="/admin/block">友情链接列表</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="icon-snowflake"></i>网站配置</a>
                        <ul class='closed'>
                            <li><a href="/admin/net">网站配置信息</a></li>
                            <li><a href="/admin/net/create">修改网站配置</a></li>
                        </ul>
                    </li>

                </ul>
            </div>         
        </div>

        
        <!-- Main Container Start -->
        <div id="mws-container" class="clearfix">
        
            <!-- Inner Container Start -->
            <div class="container">

            @section('content')

                          

            @show

            </div>
            <!-- Inner Container End -->
                       
            <!-- Footer -->
            <div id="mws-footer">
                Copyright Your Website 2012. All Rights Reserved.
            </div>
            
        </div>
        <!-- Main Container End -->
        
    </div>

    <!-- JavaScript Plugins -->
    <script src="/admins/js/libs/jquery-1.8.3.min.js"></script>
    <script src="/admins/js/libs/jquery.mousewheel.min.js"></script>
    <script src="/admins/js/libs/jquery.placeholder.min.js"></script>
    <script src="/admins/custom-plugins/fileinput.js"></script>
    
    <!-- jQuery-UI Dependent Scripts -->
    <script src="/admins/jui/js/jquery-ui-1.9.2.min.js"></script>
    <script src="/admins/jui/jquery-ui.custom.min.js"></script>
    <script src="/admins/jui/js/jquery.ui.touch-punch.js"></script>

    <!-- Plugin Scripts -->
    <script src="/admins/plugins/datatables/jquery.dataTables.min.js"></script>
    <!--[if lt IE 9]>
    <script src="/admins/js/libs/excanvas.min.js"></script>
    <![endif]-->
    <script src="/admins/plugins/flot/jquery.flot.min.js"></script>
    <script src="/admins/plugins/flot/plugins/jquery.flot.tooltip.min.js"></script>
    <script src="/admins/plugins/flot/plugins/jquery.flot.pie.min.js"></script>
    <script src="/admins/plugins/flot/plugins/jquery.flot.stack.min.js"></script>
    <script src="/admins/plugins/flot/plugins/jquery.flot.resize.min.js"></script>
    <script src="/admins/plugins/colorpicker/colorpicker-min.js"></script>
    <script src="/admins/plugins/validate/jquery.validate-min.js"></script>
    <script src="/admins/custom-plugins/wizard/wizard.min.js"></script>

    <!-- Core Script -->
    <script src="/admins/bootstrap/js/bootstrap.min.js"></script>
    <script src="/admins/js/core/mws.js"></script>

    <!-- Themer Script (Remove if not needed) -->
    <script src="/admins/js/core/themer.js"></script>

    <!-- Demo Scripts (remove if not needed) -->
    <script src="/admins/js/demo/demo.dashboard.js"></script>

    <!-- layer -->
    <script src="/admins/js/layer/layer.js"></script>


    @section('js')


    @show

</body>
</html>