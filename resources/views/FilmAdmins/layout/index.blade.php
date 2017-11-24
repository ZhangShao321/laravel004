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

<link rel="stylesheet" type="text/css" href="{{asset('/FilmAdmin/plugins/colorpicker/colorpicker.css')}}" media="screen">
<link rel="stylesheet" type="text/css" href="{{asset('/FilmAdmin/custom-plugins/wizard/wizard.css')}}" media="screen">


<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="{{asset('/FilmAdmin/bootstrap/css/bootstrap.min.css')}}" media="screen">
<link rel="stylesheet" type="text/css" href="{{asset('/FilmAdmin/css/fonts/ptsans/stylesheet.css')}}" media="screen">
<link rel="stylesheet" type="text/css" href="{{asset('/FilmAdmin/css/fonts/icomoon/style.css')}}" media="screen">

<link rel="stylesheet" type="text/css" href="{{asset('/FilmAdmin/css/mws-style.css')}}" media="screen">
<link rel="stylesheet" type="text/css" href="{{asset('/FilmAdmin/css/icons/icol16.css')}}" media="screen">
<link rel="stylesheet" type="text/css" href="{{asset('/FilmAdmin/css/icons/icol32.css')}}" media="screen">

<!-- Demo Stylesheet -->
<link rel="stylesheet" type="text/css" href="{{asset('/FilmAdmin/css/demo.css')}}" media="screen">

<!-- jQuery-UI Stylesheet -->
<link rel="stylesheet" type="text/css" href="{{asset('/FilmAdmin/jui/css/jquery.ui.all.css')}}" media="screen">
<link rel="stylesheet" type="text/css" href="{{asset('/FilmAdmin/jui/jquery-ui.custom.css')}}" media="screen">

<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css" href="{{asset('/FilmAdmin/css/mws-theme.css')}}" media="screen">
<link rel="stylesheet" type="text/css" href="{{asset('/FilmAdmin/css/themer.css')}}" media="screen">
<link rel="stylesheet" type="text/css" href="{{asset('/FilmAdmin/css/seat/jquery.seat-charts.css')}}" media="screen">

<style type="text/css">
    body, 
#mws-container
{
    /*background-image:url('../images/core/bg/paper.png');*/
}

#mws-sidebar, 
#mws-sidebar-bg, 
#mws-header, 
.mws-panel .mws-panel-header, 
#mws-login, 
#mws-login .mws-login-lock, 
.ui-accordion .ui-accordion-header, 
.ui-tabs .ui-tabs-nav, 
.ui-datepicker, 
.fc-event-skin, 
.ui-dialog .ui-dialog-titlebar, 
.jGrowl .jGrowl-notification, .jGrowl .jGrowl-closer, 
#mws-user-tools .mws-dropdown-menu .mws-dropdown-box, 
#mws-user-tools .mws-dropdown-menu.open .mws-dropdown-trigger
{
    background-color:#363d1b;
}

#mws-header
{
    border-color:#947131;
}

.mws-panel .mws-panel-header span, 
#mws-navigation ul li.active a, 
#mws-navigation ul li.active span, 
#mws-user-tools #mws-username, 
#mws-navigation ul li .mws-nav-tooltip, 
#mws-user-tools #mws-user-info #mws-user-functions #mws-username, 
.ui-dialog .ui-dialog-title, 
.ui-state-default, 
.ui-state-active, 
.ui-state-hover, 
.ui-state-focus, 
.ui-state-default a, 
.ui-state-active a, 
.ui-state-hover a, 
.ui-state-focus a
{
    color:#ffb575;
    text-shadow:0 0 6px rgba(237, 255, 41, 0.4);
}

#mws-searchbox .mws-search-submit, 
.mws-panel .mws-panel-header .mws-collapse-button span, 
.dataTables_wrapper .dataTables_paginate .paginate_disabled_previous, 
.dataTables_wrapper .dataTables_paginate .paginate_enabled_previous, 
.dataTables_wrapper .dataTables_paginate .paginate_disabled_next, 
.dataTables_wrapper .dataTables_paginate .paginate_enabled_next, 
.dataTables_wrapper .dataTables_paginate .paginate_active, 
.mws-table tbody tr.odd:hover td, 
.mws-table tbody tr.even:hover td, 
.ui-slider-horizontal .ui-slider-range, 
.ui-slider-vertical .ui-slider-range, 
.ui-progressbar .ui-progressbar-value, 
.ui-datepicker td.ui-datepicker-current-day, 
.ui-datepicker .ui-datepicker-prev, 
.ui-datepicker .ui-datepicker-next, 
.ui-accordion-header .ui-accordion-header-icon, 
.ui-dialog-titlebar-close
{
    background-color:#947131;
}


    
</style>








<link rel="stylesheet" type="text/css" href="{{asset('/FilmAdmin/css/admin.css')}}" media="screen">
<link rel="stylesheet" type="text/css" href="{{asset('/FilmAdmin/css/fenye.css')}}" media="screen">


<title>@yield('title')</title>

</head>

<body>

	<!-- Themer (Remove if not needed) -->  
	
    <!-- Themer End -->

	<!-- Header -->
	<div id="mws-header" class="clearfix">
    
    	<!-- Logo Container -->
    	<div id="mws-logo-container">
        
        	<!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
        	<div id="mws-logo-wrap">
            	<!-- <img src="images/mws-logo.png" alt="mws admin"> -->
                <h3 style="color:white">电影院后台</h3>

			</div>
        </div>
        
        <!-- User Tools (notifications, logout, profile, change password) -->
        <div id="mws-user-tools" class="clearfix">        	
            
            <!-- User Information and functions section -->
            <div id="mws-user-info" class="mws-inset">
                <?php

                    $id = session('cid');

                    $res = DB::table('cinema')->where('id',$id)->first();

                ?>
            	<!-- User Photo -->
            	<div id="mws-user-photo">
                	
                    <img src="{{asset('http://ozspa9a4f.bkt.clouddn.com/Uplodes/'.$res->clogo.'?imageView2/0/w/90/h/90')}}" id="ftou" >
                </div>
                
                <!-- Username and Functions -->
                <div id="mws-user-functions">
                    <div id="mws-username">
                        Hello, {{ $res->cinema }}
                    </div>
                    <ul>

                    	<li><a href="{{asset('/FilmAdmins/Profile')}}">修改Logo</a></li>
                        <li><a href="{{asset('FilmAdmins/pass')}}">修改密码</a></li>
                        <li><a href="{{asset('/FilmAdmins/outlogin')}}">退出</a></li>

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
                        <a href="#"><i class="icon-user"></i> 电影院管理</a>
                        <ul class="closed">

                            <li><a href="{{asset('/FilmAdmins/info')}}">电影院信息</a></li>

                           
                        </ul>
                    </li>



                    <li>
                        <a href="#"><i class="icon-th"></i> 影片管理</a>
                        <ul class="closed">
                            <li><a href="{{asset('/FilmAdmins/filmMsg')}}">影片列表</a></li>
                            <li><a href="{{asset('/FilmAdmins/filmMsgAdd')}}">添加影片</a></li>
                           
                        </ul>
                    </li>


                    <li>
                        <a href="#"><i class="icon-television"></i> 影片放映</a>
                        <ul class="closed">
                            <li><a href="{{asset('/FilmAdmins/filmShow')}}">放映列表</a></li>
                            <li><a href="{{asset('/FilmAdmins/filmShowAdd')}}">添加放映</a></li>
                           
                        </ul>
                    </li>


                    <li>
                        <a href="#"><i class="icon-home-3"></i> 影厅管理</a>
                        <ul class="closed">

                            
                            <li><a href="{{asset('/FilmAdmins/room/list')}}">影厅列表</a></li>
                            <li><a href="{{asset('/FilmAdmins/room/add')}}">添加影厅</a></li>                          


                        </ul>
                    </li>

                    <li>
                        <a href="/admins/#"><i class="icon-calendar-month"></i> 电影票</a>
                        <ul class="closed">
                            <li><a href="{{asset('/FilmAdmins/ticket/list')}}">电影票详情</a></li>
                           
                           
                        </ul>
                    </li>

                    <li>
                        <a href="/admins/#"><i class="icon-database"></i> 钱包信息</a>
                        <ul class="closed">
                            <li><a href="{{asset('/FilmAdmins/money')}}">钱包列表</a></li>
                            
                           
                        </ul>
                    </li>


                   
                    
                    
                    
                    
                    
                    
                </ul>
            </div> 

        </div>
        
        <!-- Main Container Start -->
        <div id="mws-container" class="clearfix">
        
        	<!-- Inner Container Start -->
            <div class="container">

        
             @if(session('msg'))
                <div class="mws-form-message info" id="msg">
                       {{session('msg')}}   
                </div>         
              
             @endif
             
            
            	<!-- Statistics Button Container -->
            	@section('content')


                @show
                
                <!-- Panels Start -->
                
            	
                
                <!-- Panels End -->
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
    <script src="{{asset('/FilmAdmin/js/libs/jquery-1.8.3.js')}}"></script>
    <script src="{{asset('/FilmAdmin/js/libs/jquery.mousewheel.min.js')}}"></script>
    <script src="{{asset('/FilmAdmin/js/libs/jquery.placeholder.min.js')}}"></script>
    <script src="{{asset('/FilmAdmin/custom-plugins/fileinput.js')}}"></script>
    
    <!-- jQuery-UI Dependent Scripts -->
    <script src="{{asset('/FilmAdmin/jui/js/jquery-ui-1.9.2.min.js')}}"></script>
    <script src="{{asset('/FilmAdmin/jui/jquery-ui.custom.min.js')}}"></script>
    <script src="{{asset('/FilmAdmin/jui/js/jquery.ui.touch-punch.js')}}"></script>

    <!-- Plugin Scripts -->
    <script src="{{asset('/FilmAdmin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <!--[if lt IE 9]>
    <script src="/FilmAdmin/js/libs/excanvas.min.js"></script>
    <![endif]-->
    <!-- <script src="/FilmAdmin/plugins/flot/jquery.flot.js"></script> -->
    <!-- <script src="/FilmAdmin/plugins/flot/plugins/jquery.flot.tooltip.min.js"></script> -->
    <!--<script src="/FilmAdmin/plugins/flot/plugins/jquery.flot.pie.min.js"></script>-->
    <!--<script src="/FilmAdmin/plugins/flot/plugins/jquery.flot.stack.min.js"></script>-->
    <!--<script src="/FilmAdmin/plugins/flot/plugins/jquery.flot.resize.min.js"></script>-->
    <script src="{{asset('/FilmAdmin/plugins/colorpicker/colorpicker-min.js')}}"></script>
    <script src="{{asset('/FilmAdmin/plugins/validate/jquery.validate-min.js')}}"></script>
    <script src="{{asset('/FilmAdmin/custom-plugins/wizard/wizard.min.js')}}"></script>

    <!-- Core Script -->
    <script src="{{asset('/FilmAdmin/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/FilmAdmin/js/core/mws.js')}}"></script>

    <!-- Themer Script (Remove if not needed) -->
    <script src="{{asset('/FilmAdmin/js/core/themer.js')}}"></script>

    <!-- Demo Scripts (remove if not needed) -->

    <script src="{{asset('/FilmAdmin/js/demo/demo.dashboard.js')}}"></script>
    <script src="{{asset('/FilmAdmin/js/seat/jquery.seat-charts.min.js')}}"></script>
    <!-- 引入layer -->
    <script type="text/javascript" src="{{asset('/FilmAdmin/layer/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('/FilmAdmin/layer/layer.js')}}"></script>
    <script type="text/javascript" src="{{asset('/FilmAdmin/layer/extend/layer.ext.js')}}"></script>
    <script src="{{asset('/FilmAdmin/js/seat/jquery.seat-charts.min.js')}}"></script>



    <script src="{{asset('/FilmAdmin/time/js/jquery.1.7.2.min.js')}}"></script>  
     <script src="{{asset('/FilmAdmin/time/js/jquery-1.js')}}"></script>  
    <script src="{{asset('/FilmAdmin/time/js/mobiscroll_002.js')}}" type="text/javascript"></script>  
    <script src="{{asset('/FilmAdmin/time/js/mobiscroll_004.js')}}" type="text/javascript"></script>  
    <script src="{{asset('/FilmAdmin/time/js/mobiscroll_003.js')}}" type="text/javascript"></script>  
    <script src="{{asset('/FilmAdmin/time/js/mobiscroll_004.js')}}" type="text/javascript"></script>  
    <script src="{{asset('/FilmAdmin/time/js/mobiscroll_005.js')}}" type="text/javascript"></script> 
    <script src="{{asset('/FilmAdmin/time/js/mobiscroll.js')}}" type="text/javascript"></script>  
    <link href="{{asset('/FilmAdmin/time/css/mobiscroll.css')}}" rel="stylesheet" type="text/css">  
    <link href="{{asset('/FilmAdmin/time/css/mobiscroll_002.css')}}" rel="stylesheet" type="text/css">  
    <link href="{{asset('/FilmAdmin/time/css/mobiscroll_003.css')}}" rel="stylesheet" type="text/css">
    <script src="/FilmAdmin/js/seat/jquery.seat-charts.min.js"></script>




    <script type="text/javascript">

            $('.mws-form-message').delay('3000').slideUp('2000');



            $(function(){  
            var currYear = (new Date()).getFullYear();    
            var opt={};  
            opt.date = {preset : 'date'};  
            opt.datetime = {preset : 'datetime'};  
            opt.time = {preset : 'time'};  
            opt.default = {  
                theme: 'android-ics light', //皮肤样式  
                display: 'modal', //显示方式   
                mode: 'scroller', //日期选择模式  
                dateFormat: 'yyyy-mm-dd',  
                lang: 'zh',  
                showNow: true,  
                nowText: "今天",  
                startYear: currYear - 10, //开始年份  
                endYear: currYear + 80 //结束年份  
            };  
            $("#EndDate").mobiscroll($.extend(opt['date'], opt['default']));//年月日型  
            var optDateTime = $.extend(opt['datetime'], opt['default']);  
        var optTime = $.extend(opt['time'], opt['default']);  
            $("#AbsentEndDate").mobiscroll(optDateTime).datetime(optDateTime);//年月日时分型  
            $("#EndTime").mobiscroll(optTime).time(optTime);//时分型  
  
         });  



    </script>


        @section('js')

        @show


</body>
</html>


