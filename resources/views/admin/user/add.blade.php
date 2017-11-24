
@extends('admin.layout.admins')
        
@section('title','添加用户')


@section('content')


	<div class="mws-panel grid_8">
      	<div class="mws-panel-header">
          	<span>添加用户</span>
          </div>
          <div class="mws-panel-body no-padding">

     		@if (count($errors) > 0)
			   <div class="mws-form-message error">
			       <ul>
			           @foreach ($errors->all() as $error)
			               <li style='list-style:none;'>{{ $error }}</li>
			           @endforeach
			       </ul>
				</div>
			@endif

          	<form action="{{url('admin/user/')}}" method="post" class="mws-form" enctype="multipart/form-data">
          		<div class="mws-form-inline">

          			<div class="mws-form-row">
          				<label class="mws-form-label">电话（帐号）:</label>
          				<div class="mws-form-item">
          					<input type="text" name="phone" class="small" value=""><span></span>
          				</div>
          			</div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">昵称:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="nickName" class="small" value=""><span></span>
                              </div>
                         </div>
          			<div class="mws-form-row">
          				<label class="mws-form-label">密码:</label>
          				<div class="mws-form-item">
          					<input type="password" name="password" class="small"><span></span>
          				</div>
          			</div>
          			<div class="mws-form-row">
                              <label class="mws-form-label">邮箱:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="email" class="small" value=""><span></span>
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">QQ:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="qq" class="small" value=""><span></span>
                              </div>
                         </div>

                         <div class="mws-form-row">
                              <label class="mws-form-label">头像:</label>
                              <div class="mws-form-item">
                                   <input type="file" name="photo" class="small" value="">
                              </div>
                         </div>

                         <div class="mws-form-row">
                              <label class="mws-form-label">性别:</label>
                              <div class="mws-form-item">
                                   <input type="radio" name="sex" value="m" readonly="readonly" checked> <label>男</label>
                                   <input type="radio" name="sex" readonly="readonly" value="w"> <label>女</label>
                              </div>
                         </div>
          			
          		      
					<div class="mws-form-row">
          				<label class="mws-form-label">状态：</label>
          				<div class="mws-form-item clearfix">
          					<input type="radio" name="status" value="1" readonly="readonly" checked> <label>开启</label>
                                   <input type="radio" name="status" readonly="readonly" value="0"> <label>关闭</label>
          				</div>
          			</div>  
          	    
          		</div>
          		<div class="mws-button-row">

          			{{ csrf_field() }}

          			<input type="submit" class="btn btn-danger" value="添加">
          		
          			
          		</div>
          	</form>
          </div>    	
      </div>


@endsection

@section('js')
<script type="text/javascript">

	$('.mws-form-message').delay(5000).slideUp();

     //用户名验证
     $('input[name=phone]').blur(function(){

        var reg = /^1[34578]\d{9}$/;

        var phone = $(this).val();

        $.post("{{ url('/admin/user/phone') }}", {_token:'{{ csrf_token() }}', phone:phone}, function(data){
            $('input[name=phone]').next().text(data);
        })

        var x = reg.exec(phone);

        if (x) {
            $(this).css('color','green');
            $(this).next().text(' √ ');
            $(this).next().css('color','green');
        } else {
            $(this).css('color','red');
            $(this).next().text('手机号格式不正确');
            $(this).next().css('color','red');
        }
     })

     //密码验证
     $('input[name=password]').blur(function(){

        var reg = /^\S{6,12}$/;

        var password = $(this).val();

        var x = reg.exec(password);

        if (x) {
            $(this).css('color','green');
            $(this).next().text(' √ ');
            $(this).next().css('color','green');
        } else {
            $(this).css('color','red');
            $(this).next().text('密码格式不正确');
            $(this).next().css('color','red');
        }
     })

     //昵称验证
     $('input[name=nickName]').blur(function(){

        var reg = /^\S{4,16}$/;

        var nickName = $(this).val();

        var x = reg.exec(nickName);

        if (x) {
            $(this).css('color','green');
            $(this).next().text(' √ ');
            $(this).next().css('color','green');
        } else {
            $(this).css('color','red');
            $(this).next().text('昵称格式不正确');
            $(this).next().css('color','red');
        }
     })

     //邮箱验证
     $('input[name=email]').blur(function(){

        var reg = /^\w{4,16}@[0-9a-z]+\.(com|cn|com.cn|net)$/;

        var email = $(this).val();

        var x = reg.exec(email);

        if (x) {
            $(this).css('color','green');
            $(this).next().text(' √ ');
            $(this).next().css('color','green');
        } else {
            $(this).css('color','red');
            $(this).next().text('邮箱格式不正确');
            $(this).next().css('color','red');
        }
     })

     //QQ验证
     $('input[name=qq]').blur(function(){

        var reg = /^\d{6,16}$/;

        var qq = $(this).val();

        var x = reg.exec(qq);

        if (x) {
            $(this).css('color','green');
            $(this).next().text(' √ ');
            $(this).next().css('color','green');
        } else {
            $(this).css('color','red');
            $(this).next().text('QQ格式不正确');
            $(this).next().css('color','red');
        }
     })

</script>

@endsection

