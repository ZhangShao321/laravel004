
@extends('admin.layout.admins')
        
@section('title','管理员添加')


@section('content')
<div class="mws-panel grid_8">
                    <div class="mws-panel-header">

                         <span>添加管理员</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    
                              @if (count($errors) > 0)
                                  <div class="mws-form-message warning">
                                      <ul>
                                          @foreach ($errors->all() as $error)
                                              <li style='list-style:none;'>{{ $error }}</li>
                                          @endforeach
                                      </ul>
                                  </div>
                              @endif
                                      
                         <form action="/admin/guanli/dophoto" method="post" class="mws-form" enctype='multipart/form-data'>
                              <div class="mws-form-inline">

                                   <div class="mws-form-row">
                                        <label class="mws-form-label">昵称:</label>
                                        <div class="mws-form-item">
                                             <input type="text" name="nickName" readonly="readonly" class="small" value="{{ $data->nickName }}"><span></span>
                                        </div>
                                   </div>
                                   <div style="width:240px;height:240px;border:1px solid #C5C5C5;margin:auto;">
								
										<img src="http://ozspa9a4f.bkt.clouddn.com/Uplodes/{{$data->photo}}?imageView2/0/w/240/h/240" style="width:239px;height:239px"/>
										
									</div>
					                
					              <div class="mws-form-row">
					                    <label class="mws-form-label">
					                        头像
					                    </label>
					                    <div class="mws-form-item">
					                       <input type="file" name="photo" class="large">
					                    </div>
					                </div>
                                                             
                         
                              </div>
                              <div class="mws-button-row">

                                   {{csrf_field() }}
                                   <input type="submit" class="btn btn-danger" value="修改">                            
              
                              </div>
                         </form>
                    </div>         
                </div>



@endsection

@section('js')
<script>

     $('.mws-form-message').delay(3000).slideUp(1000);

     //用户名验证
     $('input[name=phone]').blur(function(){

        var reg = /^1[34578]\d{9}$/;

        var phone = $(this).val();

        $.post("{{ url('/admin/guanliyuan/phone') }}", {_token:'{{ csrf_token() }}', phone:phone}, function(data){
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

     //重复密码
     $('input[name=repass]').blur(function(){

        var password = $('input[name=password]').val();

        var repass = $(this).val();

        if (password == repass) {
            $(this).css('color','green');
            $(this).next().text(' √ ');
            $(this).next().css('color','green');
        } else {
            $(this).css('color','red');
            $(this).next().text('两次密码不一致');
            $(this).next().css('color','red');
        }
     })

</script>

@endsection


