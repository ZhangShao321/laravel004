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

               <form action="{{url('admin/user/'.$res1->id)}}" method="post" class="mws-form" enctype="multipart/form-data">
                    <div class="mws-form-inline">

                        

                         <div class="mws-form-row">
                              <label class="mws-form-label">手机号：</label>
                              <div class="mws-form-item">
                                   <input type="text" name="phone" class="small" value="{{$res1->phone}}">
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

</script>

@endsection


