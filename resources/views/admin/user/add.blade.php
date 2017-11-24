
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
          					<input type="text" name="phone" class="small" value="">
          				</div>
          			</div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">用户名:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="nickName" class="small" value="">
                              </div>
                         </div>
          			<div class="mws-form-row">
          				<label class="mws-form-label">密码:</label>
          				<div class="mws-form-item">
          					<input type="text" name="password" class="small">
          				</div>
          			</div>
          			<div class="mws-form-row">
                              <label class="mws-form-label">邮箱:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="email" class="small" value="">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">QQ:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="qq" class="small" value="">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">性别:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="sex" class="small" value="">
                              </div>
                         </div>
          			<div class="mws-form-row">
          				<label class="mws-form-label">权限:</label>
          				<div class="mws-form-item">
          					<input type="text" disabled name="auth" class="small" value="普通用户">
          				</div>
          			</div>
          		      
					<div class="mws-form-row">
          				<label class="mws-form-label">状态：</label>
          				<div class="mws-form-item clearfix">
          					<input type="text" disabled name="status" class="small" value="开启">
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

</script>

@endsection

