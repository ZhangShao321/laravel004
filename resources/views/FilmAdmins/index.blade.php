@extends('FilmAdmins.layout.index')

@section('title', '电影院后台首页')


@section('content')
        
        <div style="font-size:30px;padding:20px">
        
             <p style="float:left">现在时间&nbsp; : &nbsp;</p>
           
            <div id="dvs" >

            </div>

        </div>
        <div class="mws-panel grid_8">
                <div class="mws-panel-header">
                    <span>
                        搜索
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




                    <form action="{{asset('/FilmAdmins/seach')}}" method="post" class="mws-form">
                        <div class="mws-form-inline">

                            <div class="mws-form-row">
                                <label class="mws-form-label">手机号</label>
                                <div class="mws-form-item">
                                    <input type="number" name="phone"><span></span>
                                </div>
                            </div>

                            

                            

                            {{ csrf_field() }}



                           
                       
                        </div>
                        <div class="mws-button-row">
                            <input type="submit" id="time" class="btn btn-danger" value="搜索">
                        </div>
                    </form>
                </div>
            </div>



@endsection



@section('js')

        
<script type="text/javascript">

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
      
     })


setInterval(function(){

    var datetime = new Date();

    //获取年
    var years = datetime.getFullYear();
    console.log(years);
    //获取月  当前月要加1
    var month = datetime.getMonth();
    console.log(month);

    if(month<10)
    {
        month = '0'+month;

    }
    //获取天

    var days = datetime.getDate();
    if(days<10)
    {
        days = '0'+days;

    }
    //获取时

    var hours = datetime.getHours();
    // console.log(hours);
     if(hours<10)
    {
        hours = '0'+hours;

    }


    //获取分

    var mins = datetime.getMinutes();
     if(mins < 10)
    {
        mins = '0'+mins ;

    }

    //获取秒Date.getSeconds( )
    var second = datetime.getSeconds();
     if(second < 10)
    {
        second = '0'+second ;

    }

  str = years + "年" + (month+1) +"月" + days+ "日"+" " +hours+':'+mins+":"+second;
   $('#dvs').html(str); 

    



},1000);
              
</script>


@endsection