@extends('admin.layout.admins')
        
@section('title','修改用户')


@section('content')

<div class="mws-panel grid_8">
          <div class="mws-panel-header">
               <span>修改用户</span>
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
                              <label class="mws-form-label">用户名:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="nickName" class="small" value="{{$res2->nickName}}">
                              </div>
                         </div>

                         <div class="mws-form-row">
                              <label class="mws-form-label">手机号：</label>
                              <div class="mws-form-item">
                                   <input type="text" name="phone" class="small" value="{{$res1->phone}}">
                              </div>
                         </div>

                         <div class="mws-form-row">
                              <label class="mws-form-label">邮箱:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="email" class="small" value="{{$res2->email}}">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">qq:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="qq" class="small" value="{{$res2->qq}}">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">性别:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="sex" class="small" value="{{$res2->sex}}">
                              </div>
                         </div>
                         
                         <div class="mws-form-row">
                              <label class="mws-form-label">权限:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="auth" disabled class="small" value="{{$res1->auth}}">
                              </div>
                         </div>
                    
                    </div>
                    <div class="mws-button-row">

                         {{csrf_field() }}
                         {{method_field('PUT')}}
                         <input type="submit" class="btn btn-danger" value="修改">
                    
                         
                    </div>
               </form>
          </div>         
      </div>

@endsection

@section('js')
<script type="text/javascript">

	$('.mws-form-message').delay(5000).slideUp();

</script>

@endsection

