@extends('homes.layout.lcr')

@section('title','找回密码')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="login-box">
    <div class="am-tabs" id="doc-my-tabs">
        <ul class="am-tabs-nav am-nav am-nav-tabs am-nav-justify">
            <li>
                <a href="">
                    找回密码
                </a>
            </li>
        </ul>
        <div class="am-tab-panel">
            <form action="" method="post">
                <div class="user-phone">
                    <label for="phone">
                        <i class="am-icon-mobile-phone am-icon-md">
                        </i>
                    </label>
                    <input type="text" name="phone" id="phone" placeholder="请输入手机号">
                </div>
                <div id="phonemsg" class="yanzheng">

                </div>
                <div class="verification">
                    <label for="code">
                        <i class="am-icon-code-fork">
                        </i>
                    </label>
                    <input type="text" name="code" id="code" placeholder="请输入验证码">
                    <a class="btn" href="" id="sendMobileCode">
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
                    <input type="password" name="password" id="newpassword" placeholder="请输入新密码">
                </div>
                <div id="newpasswordmsg" class="yanzheng">

                </div>
                <div class="user-pass">
                    <label for="passwordRepeat">
                        <i class="am-icon-lock">
                        </i>
                    </label>
                    <input type="password" name="password" id="passwordRepeat" placeholder="确认新密码">
                </div>
                <div id="confirmpasswordmsg" class="yanzheng">

                </div>
                <div>
                <a href="/homes/login" class="zcnext am-fr am-btn-default">
		            登录
		        </a>
                </div>
            </form>
            <div class="am-cf">
            	{{ csrf_field() }}
                <input type="submit" name="submit" id="submit" value="提交" class="am-btn am-btn-primary am-btn-sm am-fl">
            	
            </div>
            <hr>
        </div>
    </div>
</div>
@endsection

@section('js')

<script type="text/javascript">
	 

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var checktel = false;
    var checkverifyCode = false;
    var checkpassword = false;
    var checkrelpassword = false;

	$('#phone').blur(function() 
	{		
		checktel = checkTel($(this),$('#phonemsg'));

        // console.log(checktel);
        		 
	})

	$('#sendMobileCode').click(function() 
	{	
		// 获取手机号
		var phone = $('#phone').val();
		 // console.log(phone);
		// 发送ajax
        if(checktel == 100){

    		$.get("{{url('/homes/pass')}}",{phone:phone,'_token':"{{csrf_token()}}"},function(data) {
    		
                if(data == "1") 
    			{
    				layer.open({

                        content:  '短信已发送!!!'
                    });
    			}else if(data == " 0"){
    				 
    				layer.open({
                        content:'短信发送失败!!请重新操作!'
                    });
    			}else
                {
                    layer.open({
                        content:'手机号已注册!!'
                    });
                }

    		})
		}else{
            layer.open({

                content:'输入的手机号码格式不正确,无法获取验证码!'
            });
        }		 
		//消除默认设置 
		return false;
	})

     

	$('#code').blur(function() 
	{		
		checkverifyCode = checkVerifyCode($(this), $('#codemsg'), 6);
        // console.log(checkVerifyCode)
				
	})

	$('#newpassword').blur(function() 
	{		
		checkpassword=checkNewPassword($(this),$('#newpasswordmsg'), 6);
        

	})

	$('#passwordRepeat').blur(function() 
	{		
		checkrelpassword = checkRelPassword($('#newpassword'), $(this), $('#confirmpasswordmsg'), 6);
        

	})

	$('#submit').click(function() 
	{	
		// 获取手机号
		var phone = $('#phone').val();
		// 获取输入的验证码
		var code = $('#code').val();
		// 获取输入的密码和确认密码
		var password = $('#newpassword').val();
			
		if(checktel == 100 && checkverifyCode == 100 && checkpassword == 100 && checkrelpassword == 100){
	       	// 发送ajax
    		$.post("{{url('/homes/dopass')}}",{phone:phone,code:code,password:password,'_token':"{{csrf_token()}}"},function(data) {
    					
    			if(data==1)
    			{
    				layer.open({

                        content: '修改成功!!'
                        // return redirect('homes/login');
                    });

    			}
    		})

	 	}else{
            layer.open({

                    content: '请填写正确的修改信息!!!'
                
                });
        }
		//消除默认设置
		return false;	

 	})
	

	 

</script>	
@endsection