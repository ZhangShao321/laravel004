
@extends('admin.layout.admins')
        
@section('title','管理员添加')


@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="mws-panel grid_8">
                    <div class="mws-panel-header">

                         <span>添加管理员</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    
                              @if (count($errors) > 0)
                                  <div class="mws-form-message warning">
                                      <ul>
                                          @foreach ($errors->all() as $error)
                                              <li style='list-style:none;'>{{ $error }}</li>
                                          @endforeach
                                      </ul>
                                  </div>
                              @endif
                                      
               <form action="" style="text-align: center;" method="post" class="mws-form" enctype='multipart/form-data' id="art_form">
                                       

                   
                    <p><img src="http://ozspa9a4f.bkt.clouddn.com/Uplodes/{{$data->photo}}" alt="" id="img1" style="width:240px;margin-top: 20px;" ></p>
                    <br/>

                     <input type="file" name="photo" id="file_upload" value="">
                     <br>
                     <br/>

                        </form>
                </div>         
  </div>




@endsection

@section('js')
<script>

     $('.mws-form-message').delay(3000).slideUp(1000);

     


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); 

                  

            //头像修改 发送ajax  选择图片直接修改头像
             $("input[type='file']").change(function (){
                  
                     uploadImage();
                });
            function uploadImage() {
//            判断是否有选择上传文件
//            input type file
                var imgPath = $("#file_upload").val();
                if (imgPath == "") {
                    alert("请选择上传图片！");
                    return;
                }
                //判断上传文件的后缀名
                var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
             /*   if (strExtension != 'jpg' && strExtension != 'gif'
                    && strExtension != 'png' && strExtension != 'bmp') {
                    alert("请选择图片文件");
                    return;
                }*/
                var formData = new FormData($( "#art_form" )[0]);
                console.log(formData);
                $.ajax({
                    type: "post",
                    url: "/admin/guanli/dophoto",
                    data: formData,
                    async: true,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend:function(){

                           a = layer.load(1,{offset:['240px','750px']});
                      },
                    success: function(data) {
                        layer.close(a);

                        $('#img1').attr('src','http://ozspa9a4f.bkt.clouddn.com/Uplodes/'+data);
                        $('#tou').attr('src','http://ozspa9a4f.bkt.clouddn.com/Uplodes/'+data);

                         $('#art_thumb').val(data);
                      // location.reload();
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert("上传失败，请检查网络后重试");
                        var tp= $('#art_thumb').val();
                        $('#img1').attr('src','http://ozspa9a4f.bkt.clouddn.com/Uplodes/'+tp);
                    }
                });
            }








                       
</script>

@endsection


