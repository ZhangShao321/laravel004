@extends('admin.layout.admins')
        
@section('title','影视分类修改')

	
@section('content')
	
	<div class="mws-panel grid_8">
		<div class="mws-panel-header">
	    	<span>添加影视分类</span>
	    </div>

	    <div class="mws-panel-body no-padding">

	  	@if (session('lbt'))
	    	<div class="mws-form-message error">
	    	    <ul>
	    	        {{session('lbt')}}
	    	    </ul>
	    	</div>
	    @endif
	    
		
	    	<form action="/admin/film/{{$res->id}}" class="mws-form" method='post' enctype='multipart/form-data'>
	    		<div class="mws-form-inline">
	 
				<!-- 	<div class="mws-form-row">
					    				<label class="mws-form-label">类型:</label>
					    				<div class="mws-form-item">
					    					<input type="text" class="small" name='fname' value="">
					    				</div>
					    			</div> -->
                    	
                    		
			        <div class="mws-form-row">
			         		<label class="mws-form-label">分类:</label>
			         		<div class="mws-form-item">
			        			<input type="text" name="tname" class="small" value="{{$res->tname}}">
			         		</div>
			        </div>
                  
                    
	    			<div class="mws-form-row">
	    				<label class="mws-form-label">状态:</label>
	    				<div class="mws-form-item clearfix">
	    					<ul class="mws-form-list inline">
	    						<li><input type="radio" name='status' value='0' @if($res->status)==0 checked @endif> <label>开启</label></li>
	    						<li><input type="radio" name='status' value='1'  @if($res->status)==1 checked @endif> <label>禁用</label></li>
	    						
	    					</ul>
	    				</div>
	    			</div>
	    		</div>

	    		<div class="mws-button-row">
	    			{{ csrf_field()}}
	    			{{ method_field('PUT')}}
	    			<input type="submit" class="btn btn-info" value="修改">
	    			    			
	    		</div>
	    	</form>
	    </div>    	
	</div>
@endsection