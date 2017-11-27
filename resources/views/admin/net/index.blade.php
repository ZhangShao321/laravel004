@extends('admin.layout.admins')
        
@section('title','网站配置')

	
@section('content')
	


	<div class="mws-panel grid_8">
	<div class="mws-panel-header">
    	<span>网站配置</span>
    </div>

    <div class="mws-panel-body no-padding">

    	@if (session('msg'))
		    <div class="mws-form-message success">
		        <ul>
		            {{session('msg')}}
		        </ul>
		    </div>
		@endif

	
    	<form action="#" class="mws-form" method='post' enctype='multipart/form-data'>
    		<div class="mws-form-inline">

    			<div class="mws-form-row">
    				<label class="mws-form-label">网站名称:</label>
    				<div class="mws-form-item">
    					<input type="text" class="small" name='webname' value="{{$res[0]->webname}}">
    				</div>
    			</div>
    

                <div class="mws-form-row">
                    <label class="mws-form-label">网站联系电话:</label>
                    <div class="mws-form-item">
                        <input type="text" class="small" name='phone' value="{{$res[0]->phone}}">
                    </div>
                </div>

                 <div class="mws-form-row">
                    <label class="mws-form-label">网站邮箱:</label>
                    <div class="mws-form-item">
                        <input type="text" class="small" name='email' value="{{$res[0]->email}}">
                    </div>
                </div>

    			<div class="mws-form-row">
    				<label class="mws-form-label">网站关键字:</label>
    				<div class="mws-form-item">
    					<input type="text" class="small" name='keywords' value="{{$res[0]->keywords}}">
    				</div>
    			</div>
                
                <div class="mws-form-row">
                    <label class="mws-form-label">网站地址:</label>
                    <div class="mws-form-item">
                        <input type="text" class="small" name='address' value="{{$res[0]->address}}">
                    </div>
                </div>

    			<div class="mws-form-row">
    				<label class="mws-form-label">网站版权:</label>
    				<div class="mws-form-item">
    					<input type="text" class="small" name='copy' value="{{$res[0]->copy}}">
    				</div>
    			</div>

    			<div class="mws-form-row">
    				<label class="mws-form-label">网站logo:</label>
    				<div class="mws-form-item">

    					<img src="http://ozspa9a4f.bkt.clouddn.com/Uplodes/{{$res[0]->logo}}?imageView2/2/w/200/h/200/interlace/1/q/100|watermark/2/text/6J206J22/font/5qW35L2T/fontsize/600/fill/IzRGODBCRQ==/dissolve/78/gravity/SouthEast/dx/5/dy/6|imageslim">
                        <!-- <input type="file" readonly="readonly" style="width: 100%; padding-right: 85px;" class="fileinput-preview" placeholder="文件上传" name='logo'> -->

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

    		</div>
    		<div class="mws-button-row">
    			<!-- <input type="submit" class="btn btn-danger" value="提交"> -->
    			
    			
    		</div>
    	</form>
    </div>    	
</div>


@endsection

@section('js')

    <script type="text/javascript">

        $('.mws-form-message').delay(3000).slideUp(1000);


    </script>
@endsection
