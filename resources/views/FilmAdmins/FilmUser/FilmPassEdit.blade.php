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
			<style type="text/css">
				
					.yanzheng{
						color:red;
						text-align: center;
					}



			</style>



			       <form action="" enctype="multipart/form-data"  class="mws-form" method="post">
			            <div class="mws-form-inline">
			                <div class="mws-form-row">
			                    <label class="mws-form-label">
			                      旧密码
			                    </label>
			                    <div class="mws-form-item">
			                        <input type="password" value="" id="oldpassword" class="medium">
			                    </div>
			                    <div   id="oldpasswordmsg" class="yanzheng">
								
								</div>
			                </div>

			                 <div class="mws-form-row">
			                    <label class="mws-form-label">
			                       新密码
			                    </label>
			                    <div class="mws-form-item">
			                        <input type="password" value=""  id="newpassword" class="medium">
			                    </div>
			                     <div   id="newpasswordmsg" class="yanzheng">
								
								</div>
			                </div>
			                <div class="mws-form-row">
			                    <label class="mws-form-label">
			                       确认密码
			                    </label>
			                    <div class="mws-form-item">
			                        <input type="password" value="" id="passwordRepeat" class="medium">
			                    </div>
			                     <div   id="confirmpasswordmsg" class="yanzheng">
								
								</div>
			                </div>
			               
			               
			               

							
			              
                    		{{ csrf_field() }}

			           
			            </div>
			            <div class="mws-button-row">
			                <input type="submit" class="btn btn-danger" id="passwordchange" value="修改">
			            </div>
			        </form>
			    </div>
			</div>





@endsection



@section('js')
    <script src="{{asset('/FilmAdmin/validate.js')}}"></script>

<script type="text/javascript">


	 	$('#oldpassword').blur(function()
	 	{
	 		checkoldpassword = checkOldPassword($(this), $('#oldpasswordmsg'), 6)
	 		
	 	})
	 	
         
	 	$('#newpassword').blur(function() 
        {                         
            checknewpassword = checkNewPassword($(this),$('#newpasswordmsg'), 6)
	 	

             
        })

        $('#passwordRepeat').blur(function() 
        {       
             checkrelpassword = checkRelPassword($('#newpassword'), $(this), $('#confirmpasswordmsg'), 6)
	 		


        })

        $('#passwordchange').click(function() 
        {	
        	var Opassword = $('#oldpassword').val();


        	var Npassword = $('#newpassword').val();
        	// console.log(Opassword);
        	// console.log(Npassword);


        	

        	if(checkoldpassword ==100 && checknewpassword == 100 && checkrelpassword == 100)
        	{	
        		 $.get("{{url('/FilmAdmins/updatePass')}}",{oldpassword:Opassword,newpassword:Npassword,'_token':'{{csrf_token()}}'},function(data) {

        		
                	
	                if(data == '1')
	                {   
	                    layer.open({
	                         
	                          content: '修改成功！'
	                        }); 
	                    
	                }else if(data == 0)
	                {
		            	layer.open({
		                     
		                      content: '修改失败！'
		                    }); 
	                }else{

	                	layer.open({
		                     
		                      content: '原密码错误！'
		                    }); 

	                }

                })
        	}else
        	{
        		layer.open({  
                      content:'请填写完整的修改信息！'
                    });
        	}



        	return false;
        	
        }) 




















</script>



@endsection
