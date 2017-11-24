
@extends('admin.layout.admins')
        
@section('title','修改管理员密码')


@section('content')
<div class="mws-panel grid_8">
                    <div class="mws-panel-header">

                         <span>修改管理员密码</span>
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
                                      
                         <form action="/admin/guanli/dopass" method="post" class="mws-form" enctype='multipart/form-data'>
                              <div class="mws-form-inline">

                                   <div class="mws-form-row">
                                        <label class="mws-form-label">手机号:</label>
                                        <div class="mws-form-item">
                                             <input type="text" readonly="readonly" name="phone" class="small" value="{{$data->phone}}"><span></span>
                                        </div>
                                   </div>
                                   <div class="mws-form-row">
                                        <label class="mws-form-label">密码:</label>
                                        <div class="mws-form-item">
                                             <input type="password" name="password" class="small"><span></span>
                                        </div>
                                   </div>
                                   <div class="mws-form-row">
                                        <label class="mws-form-label">重复密码:</label>
                                        <div class="mws-form-item">
                                             <input type="password" name="repass" class="small"><span></span>
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


