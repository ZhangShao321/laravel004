@extends('admin.layout.admins')
        
@section('title','添加影视分类')

	
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
	    
		
	    	<form action="/admin/film" class="mws-form" method='post' enctype='multipart/form-data'>
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
			        			<input type="text" name="tname" class="small" value="">
			         		</div>
			        </div>
                  
                    
	    			<div class="mws-form-row">
	    				<label class="mws-form-label">状态:</label>
	    				<div class="mws-form-item clearfix">
	    					<ul class="mws-form-list inline">
	    						<li><input type="radio" name='status' value='0' checked> <label>开启</label></li>
	    						<li><input type="radio" name='status' value='1'> <label>禁用</label></li>
	    						
	    					</ul>
	    				</div>
	    			</div>
	    		</div>

	    		<div class="mws-button-row">
	    			{{ csrf_field()}}
	    			
	    			<input type="submit" class="btn btn-info" value="添加">
	    			    			
	    		</div>
	    	</form>
	    </div>    	
	</div>

@endsection

@section('js')

	<script type="text/javascript">

        $('.mws-form-message').delay(2000).slideUp(1000);

    </script>


@endsection