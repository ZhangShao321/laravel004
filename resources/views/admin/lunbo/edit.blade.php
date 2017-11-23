@extends('admin.layout.admins')
        

@section('title','修改轮播图')

	
@section('content')
	


<div class="mws-panel grid_8">
		<div class="mws-panel-header">
	    	<span>修改轮播图</span>
	    </div>

	    <div class="mws-panel-body no-padding">

	  	@if (session('msg'))
	    	<div class="mws-form-message error">
	    	    <ul>
	    	        {{session('msg')}}
	    	    </ul>
	    	</div>
	    @endif
	    		
	    	<form action="/admin/lunbo/{{$sql->id}}" class="mws-form" method='post' enctype='multipart/form-data'>
	    		<div class="mws-form-inline">

	    			<div class="mws-form-row">
	    				<label class="mws-form-label">轮播图:</label>
	    				<div class="mws-form-item">
	    					<img src="http://ozspa9a4f.bkt.clouddn.com/Uplodes/{{($sql->picname)}}?imageView2/2/w/160/h/160"><input type="file" readonly="readonly" style="width: 100%; padding-right: 85px;" class="fileinput-preview" placeholder="文件上传" name='picname'>
	    				</div>
	    			</div>
					
					<div class="mws-form-row">
	    				<label class="mws-form-label">电影名称:</label>
	    				<div class="mws-form-item">
	    					<input type="text" class="small" name='fname' value="{{$sql->fname}}">
	    				</div>
	    			</div>

	    	
	    			<div class="mws-form-row">
	    				<label class="mws-form-label">状态:</label>
	    				<div class="mws-form-item clearfix">
	    					<ul class="mws-form-list inline">
	    						<li><input type="radio" name='status' value='0' @if($sql->status == 0) checked @endif><label>正在使用</label></li>
	    						<li><input type="radio" name='status' value='1' @if($sql->status == 1) checked @endif><label>未使用</label></li>
	    						
	    					</ul>
	    				</div>
	    			</div>
	    		</div>
	    		<div class="mws-button-row">
	    			{{ csrf_field() }}
	    			{{method_field('PUT') }}
	    			<input type="submit" class="btn btn-primary" value="修改">
	    			    			
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