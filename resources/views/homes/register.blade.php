@extends('homes.layout.lcr')

@section('title','注册')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="login-box">
    <div class="am-tabs" id="doc-my-tabs">
        <ul class="am-tabs-nav am-nav am-nav-tabs am-nav-justify">
            <li>
                <a href="">
                    手机号注册
                </a>
            </li>
        </ul>
        <div class="am-tab-panel">
            <form  action="{{ url('/homes/doregister/') }}" method="post">
                <div class="user-phone">
                    <label for="phone">
                        <i class="am-icon-mobile-phone am-icon-md">
                        </i>
                    </label>
                    <input type="tel" name="tel" id="phone" placeholder="请输入手机号">
                </div>
                <div id="phonemsg" class="yanzheng">

                </div>
                <div class="verification">
                    <label for="code">
                        <i class="am-icon-code-fork">
                        </i>
                    </label>
                    <input type="text" name="code" id="code" placeholder="请输入验证码">
                    <a class="btn" href="/homes/test" id="sendMobileCode">
                        <span id="dyMobileButton">
                            获取
                        </span>
                    </a>
                </div>
                <div id="codemsg" class="yanzheng">

                </div>
                <div class="user-pass">
                    <label for="password">
                        <i class="am-icon-lock">
                        </i>
                    </label>
                    <input type="password" name="password" id="password" placeholder="设置密码">
                </div>
                <div id="passwordmsg" class="yanzheng">

                </div>
                <div class="user-pass">
                    <label for="passwordRepeat">
                        <i class="am-icon-lock">
                        </i>
                    </label>
                    <input type="password" name="confirmpassword" id="passwordRepeat" placeholder="确认密码">
                </div>
                <div id="confirmpasswordmsg" class="yanzheng">

                </div>
                <div>
                <a href="/homes/login" class="zcnext am-fr am-btn-default">
		            登录
		        </a>
                </div>
				@if(session('msg'))
                	<div class="mws-form-message info" id="msg">

           
                	{{session('msg')}}   
                	</div>         
          
            	@endif
             


            </form>
            <div class="am-cf">
            	{{ csrf_field() }}
                <input type="submit" id="submit" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
            	
            </div>
            <hr>
        </div>
    </div>
</div>
@endsection

@section('js')

<script type="text/javascript">
	// var checktel = false;
	// var checkVerifyCode=false;
	// var checkpassword = false;
	// var checkrelpassword = false;


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

	$('#phone').blur(function() 
	{		
		checktel = checkTel($(this),$('#phonemsg'));			 
	})

	$('#sendMobileCode').click(function() 
	{	
		// 获取手机号
		var phone = $('#phone').val();
		// 发送ajax
		$.get('{{url('/homes/test')}}',{phone:phone},function(data) {
			if (data) 
			{
				return('短信已发送');
			}else{
				 
				return('发送失败');
			}

		},'json')
				 
		//消除默认设置 
		return false;
	})

	$('#code').blur(function() 
	{		
		checkVerifyCode = checkVerifyCode($(this), $('#codemsg'), 6);
				
	})

	$('#password').blur(function() 
	{		
		checkpassword=checkPassword($(this),$('#passwordmsg'), 6);

	})

	$('#passwordRepeat').blur(function() 
	{		
		checkrelpassword = checkRelPassword($('#password'), $(this), $('#confirmpasswordmsg'), 6);

	})

	$('#submit').click(function() 
	{	
		// 获取手机号
		var phone = $('#phone').val();
		// 获取输入的验证码
		var code = $('#code').val();
		// 获取输入的密码和确认密码
		var password = $('#password').val();
			
	// 	if(checktel == 100 && checkverifyCode == 100 && checkpassword == 100 && checkrelpassword == 100){
	// 		// 发送ajax
		$.post("{{url('/homes/doregister')}}",{phone:phone,code:code,password:password,'_token':"{{csrf_token()}}"},function(data) {
					
			if(data)
			{
				return('注册成功!!!');

			}else{

	 			return('请输入正确的注册方式!!');

	 		}

		})

	 	
		//消除默认设置
		return false;
			

 	})
	

	 

</script>	
@endsection