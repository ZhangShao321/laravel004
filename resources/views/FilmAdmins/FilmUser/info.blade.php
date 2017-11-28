@extends('FilmAdmins.layout.index')

@section('title', '电影院信息')


@section('content')

	<!-- <h1>这是电影院信息</h1> -->

     
		<div class="mws-panel grid_8">
			    <div class="mws-panel-header">
			        <span>
			            电影院信息
			        </span>
			    </div>
			    <div class="mws-panel-body no-padding">
			    
			        <form action="{{asset('/FilmAdmins/filmUp')}}" method="post" enctype="multipart/form-data"  class="mws-form">
			            <div class="mws-form-inline">
			                <div class="mws-form-row">
			                    <label class="mws-form-label">
			                        电影院名称
			                    </label>
			                    <div class="mws-form-item">
			                        <input type="text" name="cinema" class="medium" value="{{$res['cinema']}}">
			                    </div>
			                </div>
			                <div class="mws-form-row">
			                    <label class="mws-form-label">
			                        电影院法人
			                    </label>
			                    <div class="mws-form-item">
			                        <input type="text" name="legal" value="{{$res['legal']}}" class="medium">
			                    </div>
			                </div>
			                <div class="mws-form-row">
			                    <label class="mws-form-label">
			                        电话
			                    </label>
			                    <div class="mws-form-item">
			                        <input type="text" name="phone" value="{{$res['phone']}}" class="medium">
			                    </div>
			                </div>

			                 <div class="mws-form-row">
			                    <label class="mws-form-label">
			                        城市
			                    </label>
			                    <div class="mws-form-item">
			                        <input type="text" name="city" value="{{$res['city']}}" class="medium">
			                    </div>
			                </div>


			                 <div class="mws-form-row">
			                    <label class="mws-form-label">
			                        区域
			                    </label>
			                    <div class="mws-form-item">
			                        <input type="text" name="area" value="{{$res['area']}}" class="medium">
			                    </div>
			                </div>

			                 <div class="mws-form-row">
			                    <label class="mws-form-label">
			                       状态
			                    </label>
			                    <div class="mws-form-item">
			                    	<select class="large" name="status">

                                          <option  value="0" @if($res['status'] == 0) selected  @endif >关闭</option>
                                          <option  value="1"@if($res['status'] == 1) selected  @endif >开启 </option>
                                    </select>
			                        
			                    </div>
			                </div>

							   <div class="mws-form-row">
			                    <label class="mws-form-label">
			                        影院logo
			                    </label>
			                    <div class="mws-form-item">
			                    	<div style="width:180px;height:220px;border:1px solid #C5C5C5;margin-bottom: 5px">
			                    		
										  <img src="{{asset('http://ozspa9a4f.bkt.clouddn.com/Uplodes/'.$res['clogo'].'?imageView2/0/w/220/h/220')}}" style="width:100%;height:218px;" >

			                    	</div>

			                    </div>
			                </div>


			               
			                <div class="mws-form-row">
			                    <label class="mws-form-label">
			                        影院执照
			                    </label>
			                    <div class="mws-form-item">
			                    	<div style="width:180px;height:220px;border:1px solid #C5C5C5;margin-bottom: 5px">
			                    		
										  <img src="{{asset('http://ozspa9a4f.bkt.clouddn.com/Uplodes/'.$res['license'].'?imageView2/0/w/220/h/220')}}" style="width:100%;height:218px;" >

			                    	</div>
			                        <input type="file" name="license" value="" class="medium">

			                    </div>
			                </div>

							 

			                 <div class="mws-form-row">
			                    <label class="mws-form-label">
			                       影院详细地址
			                    </label>
			                    <div class="mws-form-item">
			                        <textarea class="medium" name="address" cols="" rows="">
			                        	{{$res['address']}}
			                        </textarea>
			                    </div>
			                </div>
			                    		{{ csrf_field() }}

			           
			            </div>
			            <div class="mws-button-row">
			                <input type="submit" class="btn btn-danger" value="保存">
			               
			            </div>
			        </form>
			     
			    </div>
			</div>






@endsection