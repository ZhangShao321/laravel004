@extends('admin.layout.admins')
        
@section('title','编辑用户')


@section('content')

<div class="mws-panel grid_8">
          <div  class="mws-panel-header">
               <span >编辑用户 | <a href="/admin/user/pass">编辑密码</a></span>
               
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

               <form action="{{url('admin/user/'.$res1->id)}}" method="post" class="mws-form" enctype="multipart/form-data">
                    <div class="mws-form-inline">
                         <div class="mws-form-row">
                              <label class="mws-form-label">手机号：</label>
                              <div class="mws-form-item">
                                   <input type="text" readonly="readonly" name="phone" class="small" value="{{$res1->phone}}">
                              </div>
                         </div>

                         <div class="mws-form-row">
                              <label class="mws-form-label">昵称:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="nickName" class="small" value="{{$res2->nickName}}">
                              </div>
                         </div>


                         <div class="mws-form-row">
                              <label class="mws-form-label">邮箱:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="email" class="small" value="{{$res2->email}}">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">QQ:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="qq" class="small" value="{{$res2->qq}}">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">性别:</label>
                              <div class="mws-form-item">
                                   <input type="radio" name="sex" value="m" readonly="readonly" checked> <label>男</label>
                                   <input type="radio" name="sex" readonly="readonly" value="w"> <label>女</label>
                              </div>
                         </div>
                         
                         
                    
                    </div>
                    <div class="mws-button-row">

                         {{csrf_field() }}
                         {{method_field('PUT')}}
                         <input type="submit" class="btn btn-danger" value="编辑">
                    
                         
                    </div>
               </form>
          </div>         
      </div>

@endsection

@section('js')
<script type="text/javascript">

	$('.mws-form-message').delay(5000).slideUp();

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



