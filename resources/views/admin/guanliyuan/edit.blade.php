
@extends('admin.layout.admins')
        
@section('title','管理员编辑')


@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">

         <span>管理员编辑</span>
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
                      
         <form action="/admin/guanliyuan/{{ $data->id }}" method="post" class="mws-form" enctype='multipart/form-data'>
              <div class="mws-form-inline">

                   <div class="mws-form-row">
                        <label class="mws-form-label">手机号:</label>
                        <div class="mws-form-item">
                             <input type="text" name="phone" class="small" value="{{$data->phone}}"><span></span>
                        </div>
                   </div>
                   <div class="mws-form-row">
                        <label class="mws-form-label">昵称:</label>
                        <div class="mws-form-item">
                             <input type="text" name="nickName" value="{{ $res->nickName }}" class="small"><span></span>
                        </div>
                   </div>
                   <div class="mws-form-row">
                        <label class="mws-form-label">邮箱:</label>
                        <div class="mws-form-item">
                             <input type="email" name="email" value="{{ $res->email }}" class="small"><span></span>
                        </div>
                   </div>

                   <div class="mws-form-row">
                        <label class="mws-form-label">QQ:</label>
                        <div class="mws-form-item">
                             <input type="text" name="qq" value="{{ $res->qq }}" class="small"><span></span>
                        </div>
                   </div>


                   <!--  最后登录时间 -->
            
                  
                   <div class="mws-form-row">
                        <label class="mws-form-label">权限</label>
                        <div class="mws-form-item clearfix">
                             <ul class="mws-form-list inline">
                                <li><input type="radio" name="auth" @if($data->auth == 1) checked  @endif value="1" readonly="readonly" checked> <label>开启</label></li>
                                <li><input type="radio" name="auth" @if($data->auth == 0) checked  @endif readonly="readonly" value="0"> <label>关闭</label></li>
                                  
                             </ul>
                        </div>
                   </div>   
                  
                  <div class="mws-form-row">
                      <label class="mws-form-label">状态</label>
                      <div class="mws-form-item">
                          <select class="status" name="status">
                              <option @if($data->status == 1) selected @endif value="1">普通管理员</option>
                              <option @if($data->status == 2) selected @endif value="2">中级管理员</option>
                              <option @if($data->status == 3) selected @endif value="3">超级管理员</option>
                          </select>
                      </div>
                  </div>
                                             
         
              </div>
              <div class="mws-button-row">

                   {{csrf_field() }}
                   {{ method_field('PUT') }}
                   <input type="submit" class="btn btn-danger" value="编辑">                            

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


