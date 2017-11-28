
@extends('admin.layout.admins')
        
@section('title','管理员添加')


@section('content')
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
                        
           <form action="/admin/guanliyuan" method="post" class="mws-form" enctype='multipart/form-data'>
                <div class="mws-form-inline">

                     <div class="mws-form-row">
                          <label class="mws-form-label">手机号:</label>
                          <div class="mws-form-item">
                               <input type="text" name="phone" class="small" value="{{old('phone')}}"><span></span>
                          </div>
                     </div>
                     <div class="mws-form-row">
                          <label class="mws-form-label">密码:</label>
                          <div class="mws-form-item">
                               <input type="password" name="password" class="small"><span></span>
                          </div>
                     </div>


                     <div class="mws-form-row">
                          <label class="mws-form-label">重复密码:</label>
                          <div class="mws-form-item">
                               <input type="password" name="repass" class="small"><span></span>
                          </div>
                     </div>


                     <!--  最后登录时间 -->
                      <!-- <div class="mws-form-row">
                          <label class="mws-form-label">最后登录时间:</label>
                          <div class="mws-form-item">            
                              <div class="jeinpbox"><input type="text" class="jeinput" id="test04" placeholder="YYYY-MM-DD hh:mm:ss" name="lastlogin">
                              </div>                                 
                          </div>
                                                         </div> -->
                    
                     <div class="mws-form-row">
                          <label class="mws-form-label">权限</label>
                          <div class="mws-form-item clearfix">
                               <ul class="mws-form-list inline">
                                  <li><input type="radio" name="auth" value="1" readonly="readonly" checked> <label>开启</label></li>
                                  <li><input type="radio" name="auth" readonly="readonly" value="0"> <label>关闭</label></li>
                                    
                               </ul>
                          </div>
                     </div>   
                    
                    <div class="mws-form-row">
                        <label class="mws-form-label">状态</label>
                        <div class="mws-form-item">
                            <select class="status" name="status">
                                <option selected value="1">普通管理员</option>
                                <option value="2">中级管理员</option>
                                <option value="3">超级管理员</option>
                            </select>
                        </div>
                    </div>
                                               
           
                </div>
                <div class="mws-button-row">

                     {{csrf_field() }}

                     <input id="but" type="submit" class="btn btn-danger" value="添加">            
                </div>
           </form>
      </div>         
  </div>



@endsection

@section('js')
<script>

     $('.mws-form-message').delay(3000).slideUp(1000);


     //用户名验证
     $('input[name=phone]').blur(function(){

        var reg = /^1[34578]\d{9}$/;

        var phone = $(this).val();


        var x = reg.exec(phone);

        if (x) {
            $(this).css('color','green');
            $(this).next().text(' √ ');
            $(this).next().css('color','green');
        } else {
            $(this).css('color','red');
            $(this).next().text('手机号格式不正确');
            $(this).next().css('color','red');

            $('#but').click(function(){

              return false;
            })
            return

        }
        $.post("{{ url('/admin/guanliyuan/phone') }}", {_token:'{{ csrf_token() }}', phone:phone}, function(data){
            $('input[name=phone]').next().text(data);
        })
     })

     //密码验证
     $('input[name=password]').blur(function(){

        var reg = /^\S{6,12}$/;

        var password = $(this).val();

        var x = reg.exec(password);

        if (x) {
            $(this).css('color','green');
            $(this).next().text(' √ ');
            $(this).next().css('color','green');
        } else {
            $(this).css('color','red');
            $(this).next().text('密码格式不正确');
            $(this).next().css('color','red');

            $('#but').click(function(){

              return false;
            })
        }
     })

     //重复密码
     $('input[name=repass]').blur(function(){

        var password = $('input[name=password]').val();

        var repass = $(this).val();

        if (password == repass) {
            $(this).css('color','green');
            $(this).next().text(' √ ');
            $(this).next().css('color','green');
        } else {
            $(this).css('color','red');
            $(this).next().text('两次密码不一致');
            $(this).next().css('color','red');

            $('#but').click(function(){

              return false;
            })
        }
     })

      $('#but').on('click', function(){
                          
          layer.msg('管理员添加成功:)');
      });




/*$(function(){  
            var currYear = (new Date()).getFullYear();    
            var opt={};  
            opt.date = {preset : 'date'};  
            opt.datetime = {preset : 'datetime'};  
            opt.time = {preset : 'time'};  
            opt.default = {  
                theme: 'android-ics light', //皮肤样式  
                display: 'modal', //显示方式   
                mode: 'scroller', //日期选择模式  
                dateFormat: 'yyyy-mm-dd',  
                lang: 'zh',  
                showNow: true,  
                nowText: "今天",  
                startYear: currYear - 10, //开始年份  
                endYear: currYear + 80 //结束年份  
            };  
            $("#EndDate").mobiscroll($.extend(opt['date'], opt['default']));//年月日型  
            var optDateTime = $.extend(opt['datetime'], opt['default']);  
        var optTime = $.extend(opt['time'], opt['default']);  
            $("#AbsentEndDate").mobiscroll(optDateTime).datetime(optDateTime);//年月日时分型  
            $("#EndTime").mobiscroll(optTime).time(optTime);//时分型  
  
         });  */
</script>

@endsection


