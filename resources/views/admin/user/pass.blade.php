@extends('admin.layout.admins')
        
@section('title','编辑用户密码')


@section('content')

<div class="mws-panel grid_8">
          <div class="mws-panel-header">
               <span>编辑用户密码</span>
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

               <form action="{{url('admin/user/dopass')}}" method="post" class="mws-form" enctype="multipart/form-data">
                    <div class="mws-form-inline">

                        

                         <div class="mws-form-row">
                              <label class="mws-form-label">手机号：</label>
                              <div class="mws-form-item">
                                   <input type="text" name="phone" class="small" value="{{$res->phone}}">
                              </div>
                         </div>

                         <div class="mws-form-row">
                              <label class="mws-form-label">密码:</label>
                              <div class="mws-form-item">
                                   <input type="password" name="password" class="small"><span></span>
                              </div>
                         </div>

                    
                    </div>
                    <div class="mws-button-row">
						<input type="hidden" name="id" value="{{ $res->id }}">
                         {{csrf_field() }}
                         <input type="submit" class="btn btn-danger" value="编辑">
                    
                         
                    </div>
               </form>
          </div>         
      </div>

@endsection

@section('js')
<script type="text/javascript">

	$('.mws-form-message').delay(5000).slideUp();

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

</script>

@endsection


