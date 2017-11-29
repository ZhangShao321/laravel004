@extends('admin.layout.admins')
        
@section('title','商户修改')


@section('content')

<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>
            商户修改
        </span>
    </div>
    <div class="mws-panel-body no-padding">
        <form action="{{url('admin/movie/'.$res->id)}}" method="post" class="mws-form" enctype="multipart/form-data">
        	@if (session('msg'))
	    	<div class="mws-form-message error">
	    	    <ul>
	    	        {{session('msg')}}
	    	    </ul>
	    	</div>
		    @endif
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">
                        电影院名称：
                    </label>
                    <div class="mws-form-item">
                        <input class="small" name="cinema" type="text" value="{{$res->cinema}}">
                    </div>
                </div>

                <div class="mws-form-row">
                    <label class="mws-form-label">
                        电影名称：
                    </label>
                    <div class="mws-form-item">
                        <input class="small" name="filmname" type="text" value="{{$res->filmname}}">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">
                        电影时长：
                    </label>
                    <div class="mws-form-item">
                        <input class="small" name="filmtime" type="text" value="{{$res->filmtime}}">
                    </div>
                </div>
				<div class="mws-form-row">
                    <label class="mws-form-label">
                        关键词：
                    </label>
                    <div class="mws-form-item">
                        <input class="small" name="keywords" type="text" value="{{$res->keywords}}">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">
                        导演：
                    </label>
                    <div class="mws-form-item">
                        <input class="small" name="director" type="text" value="{{$res->director}}">
                    </div>
                </div>
                
                <div class="mws-form-row">
                    <label class="mws-form-label">
                        价格：
                    </label>
                    <div class="mws-form-item">
                        <input class="small" name="price" type="text" value="{{$res->price}}">
                    </div>
                </div>
                <div class="mws-form-row">
    				<label class="mws-form-label">网站状态</label>
    				<div class="mws-form-item clearfix">
    					<ul class="mws-form-list inline">
    						<li><input type="radio" name='status' value='1' checked> <label>上映</label></li>
    						<li><input type="radio" name='status' value='0'> <label>下架</label></li>
    						
    					</ul>
    				</div>
    			</div>

            </div>
            <div class="mws-button-row">
           		{{csrf_field() }}
                {{method_field('PUT')}}
                <input value="修改" class="btn btn-primary" type="submit">
            </div>
        </form>
    </div>
</div>

@endsection


