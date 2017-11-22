@extends('FilmAdmins.layout.index')

@section('title', '密码修改')


@section('content')
     
		<div class="mws-panel grid_8">
			    <div class="mws-panel-header">
			        <span>
			            密码修改
			        </span>
			    </div>
			    <div class="mws-panel-body no-padding">

			 @if (count($errors) > 0)
	            <div class="mws-form-message error">
	                <ul>
	                    @foreach ($errors->all() as $error)
	                        <li>{{ $error }}</li>
	                    @endforeach
	                </ul>
	            </div>
	        @endif




			       <form action="" enctype="multipart/form-data"  class="mws-form" method="post">
			            <div class="mws-form-inline">
			                <div class="mws-form-row">
			                    <label class="mws-form-label">
			                      原先密码
			                    </label>
			                    <div class="mws-form-item">
			                        <input type="text" value="" name="filmname" class="medium">
			                    </div>
			                </div>

			                 <div class="mws-form-row">
			                    <label class="mws-form-label">
			                       新密码
			                    </label>
			                    <div class="mws-form-item">
			                        <input type="text" value="" name="filmname" class="medium">
			                    </div>
			                </div>
			                <div class="mws-form-row">
			                    <label class="mws-form-label">
			                       确认密码
			                    </label>
			                    <div class="mws-form-item">
			                        <input type="text" value="" name="filmname" class="medium">
			                    </div>
			                </div>
			               
			               
			               

							
			              
                    		{{ csrf_field() }}

			           
			            </div>
			            <div class="mws-button-row">
			                <input type="submit" class="btn btn-danger" value="修改">
			            </div>
			        </form>
			    </div>
			</div>





@endsection