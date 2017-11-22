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
			                        <input type="text" name="cinema" class="medium" value="{{$res[0]->cinema}}">
			                    </div>
			                </div>
			                <div class="mws-form-row">
			                    <label class="mws-form-label">
			                        电影院法人
			                    </label>
			                    <div class="mws-form-item">
			                        <input type="text" name="legal" value="{{$res[0]->legal}}" class="medium">
			                    </div>
			                </div>
			                <div class="mws-form-row">
			                    <label class="mws-form-label">
			                        电话
			                    </label>
			                    <div class="mws-form-item">
			                        <input type="text" name="phone" value="{{$res[0]->phone}}" class="medium">
			                    </div>
			                </div>

			                 <div class="mws-form-row">
			                    <label class="mws-form-label">
			                        城市
			                    </label>
			                    <div class="mws-form-item">
			                        <input type="text" name="city" value="{{$res[0]->city}}" class="medium">
			                    </div>
			                </div>


			                 <div class="mws-form-row">
			                    <label class="mws-form-label">
			                        区域
			                    </label>
			                    <div class="mws-form-item">
			                        <input type="text" name="area" value="{{$res[0]->area}}" class="medium">
			                    </div>
			                </div>

			                 <div class="mws-form-row">
			                    <label class="mws-form-label">
			                       状态
			                    </label>
			                    <div class="mws-form-item">
			                    	<select class="large" name="status">

                                          <option  value="0" @if($res[0]->status == 0) selected  @endif >关闭</option>
                                          <option  value="1"@if($res[0]->status == 1) selected  @endif >开启 </option>
                                    </select>
			                        
			                    </div>
			                </div>




			               
			                <div class="mws-form-row">
			                    <label class="mws-form-label">
			                        影院执照
			                    </label>
			                    <div class="mws-form-item">
			                    	<div style="width:180px;height:220px;border:1px solid #C5C5C5;margin-bottom: 5px">
			                    		
										  <img src="{{asset($res[0]->license)}}" style="width:100%;height:218px;" >

			                    	</div>
			                        <input type="file" name="license" value="" class="medium">

			                    </div>
			                </div>

							 <div class="mws-form-row">
			                    <label class="mws-form-label">
			                       影院地址
			                    </label>
			                    <div class="mws-form-item">
			                        <textarea class="medium" name="area"  cols="" rows="">
			                        	{{$res[0]->area}}
			                        </textarea>
			                    </div>
			                </div>

			                 <div class="mws-form-row">
			                    <label class="mws-form-label">
			                       影院详细地址
			                    </label>
			                    <div class="mws-form-item">
			                        <textarea class="medium" name="address" cols="" rows="">
			                        	{{$res[0]->address}}
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