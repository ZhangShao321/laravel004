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
        <form action="{{url('admin/cinema/'.$res->id)}}" method="post" class="mws-form" enctype="multipart/form-data">
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
                        手机号：
                    </label>
                    <div class="mws-form-item">
                        <input class="small" name="phone" type="text" value="{{$res->phone}}">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">
                        省：
                    </label>
                    <div class="mws-form-item">
                        <input class="small" name="city" type="text" value="{{$res->city}}">
                    </div>
                </div>
				<div class="mws-form-row">
                    <label class="mws-form-label">
                        市：
                    </label>
                    <div class="mws-form-item">
                        <input class="small" name="area" type="text" value="{{$res->area}}">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">
                        县：
                    </label>
                    <div class="mws-form-item">
                        <input class="small" name="address" type="text" value="{{$res->address}}">
                    </div>
                </div>
                
                <div class="mws-form-row">
                    <label class="mws-form-label">
                        法人
                    </label>
                    <div class="mws-form-item">
                        <input class="small" name="legal" type="text" value="{{$res->legal}}">
                    </div>
                </div>
                <div class="mws-form-row">
    				<label class="mws-form-label">网站状态</label>
    				<div class="mws-form-item clearfix">
    					<ul class="mws-form-list inline">
    						<li><input type="radio" name='status' value='1' checked> <label>开启</label></li>
    						<li><input type="radio" name='status' value='0'> <label>禁止</label></li>
    						
    					</ul>
    				</div>
    			</div>
                <div class="mws-form-row">
    				<label class="mws-form-label">网站logo</label>
    				<div class="mws-form-item">
    					<img src="{{asset($res->clogo)}}" style="width:50px;height:50px;"><input type="file" readonly="readonly" style="width: 100%; padding-right: 85px;" class="fileinput-preview" placeholder="文件上传" name='clogo'>
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


