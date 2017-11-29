@extends('homes.layout.moban')

@section('title','选座订票页')

<style>
    #seat-maps .seatCharts-cell{
        width: 30px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        font-size: 18px;
        background: #fff;
    }

    #seat-maps .cur{
        width: 30px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        font-size: 18px;
        background: blue;
    }
    #seat-maps .none{
        width: 30px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        font-size: 18px;
        background: red;
    }

    #seat-maps .curs{
        width: 30px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        font-size: 18px;
        background: #ddd;
    }
    #seat-maps .aaa{
        width: 30px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        font-size: 18px;
        background: white;
    }
    #xiugai{
        height: 50px;
        padding-left: 20px;
        background: lightblue;
        padding-top: 10px;
    }
    #seat-maps{
        margin: 10px auto; 
        width: auto;
        height: auto;   
    }

    #mmm{
        width: auto;
        height: auto; 
    }
    #ccc{
        width: auto;
        height: 40px;
        line-height: 40px;
        text-align: center;
    }
    
</style>
@section('content') 
<center>
<div class="mws-panel grid_8">
    
    <div class="mws-panel-body no-padding">
        <form class="mws-form">
        <div class="mws-form-block">

                 
            <div class="mws-form-row">
                <!-- <label class="mws-form-label"><h2> 座 位 图 </h2></label> -->
                <input type="hidden" id="x" value="{{ $data->hang }}"  name="hang">
                <input type="hidden" id="y"  value="{{ $data->lie }}" name="lie">
                 <br/>  
                <div id="mmm" style="" class="mws-form-item">

                    <table>
                        <tr align="center">
                            <td>
                                <div id="ccc"><img src="/homes/ticket_screen.jpg" alt=""></div>
                                <p><h2>{{ $cinema->cinema }}</h2></p>
                                <p><h2>{{ $room->roomname }}{{ $room->roomtype }}</h2></p>
                            </td>
                            <!-- <td>dddddddddddd</td> -->
                        </tr>
                        <tr>
                            <td><div  class=""  id="seat-maps"></td>
                            <!-- <td>ddddddddddddddddddd</td> -->
                        </tr>
                    </table>

                    </div>
                 
                </div>
                <ul id="selected-seats"></ul>
            </div> 
            <br>
        </div>
        </form>
            <div class="mws-button-row" id="xiugai"  >
                <button id="goumai"  class="btn btn-danger">购买</button> 
                
            </div>
        
    </div>
</div>
</center>

@endsection
@section('js')      
<script>

var firstSeatLabel = 1;

$(document).ready(function() {
    registSeat();

    /*$("#save").on("click",function(){
        $.get("save?str="+map).success(function(data){
            console.log(data);
        });
    });*/
});

var map = new Array();

function registSeat(){

    var x = parseInt($("#x").val());
    var y = parseInt($("#y").val());
    map = [];
    for(var i=0;i<x;i++){
        map[i]="";
        for(var j=0;j<y;j++){
            map[i]+="e";
        }
    }
    $('#seat-maps').empty();
    $("#legend").empty();
    firstSeatLabel = 1;
    var sc = $('#seat-maps').seatCharts({
        map: map,
        naming: {
            top: false, //不显示顶部横坐标（行） 
            left:false,
            getLabel: function(character, row, column) { //返回座位信息 
                return firstSeatLabel++;
            }
        },
        legend: {
            node: $('#legend'),
            items: [
                [ 'e', 'available',   '位置' ],
                [ 'e', 'none', '过道']
            ]
        },
        click: function() {
             if (this.status() == 'available') { //若为可选座状态，添加座位
                map[this.settings.row]=map[this.settings.row].substring(0,this.settings.column)+"_"+map[this.settings.row].substring(this.settings.column+1);
                return 'none';
             }else {
                map[this.settings.row]=map[this.settings.row].substring(0,this.settings.column)+"e"+map[this.settings.row].substring(this.settings.column+1);
                return "available";
            }  
        }
    });

        // sc.get(['1_2', '4_1', '7_1', '7_2']).status('none');
    //可选座位
    @foreach($seat as $k=>$v)

        $("#{{ $v }}").addClass('cur');

    @endforeach

    //不可选的座位
    $('.seatCharts-cell').each(function(){

        // console.log($(this).attr('class')); //seatCharts-seat seatCharts-cell available cur
        if($(this).attr('class') != 'seatCharts-seat seatCharts-cell available cur'){

            
            $(this).click(function(){
                $(this).removeClass('none');
            });
        }
    })

    zuos();

    //购票
    $('#goumai').click(function(){

                var info = [];
                $('.none').each(function(){

                    //获取座位号
                    var zuo = $(this).attr('id');

                    info.push(zuo);

                })
                
                var into = info.join('#');

                if(!into){
                    // alert('请选择电影票!!');
                    layer.alert('请选择电影票!!', {icon: 6});
 
                }else{

                    var reg = /^\w{3,5}$/;
                    if(!reg.exec(into)){

                        // alert('抱歉!一次只能买一张!');
                        layer.alert('抱歉!一次只能买一张!', {icon: 6});
                    }else{

                        //发送ajax      into = '4_5#4_6#4_7'
                        $.post('{{ url("/homes/shopseat/$id") }}',{_token:'{{ csrf_token() }}', zuo:into},function(data){

                                if(data == '购买失败'){

                                    layer.alert(data, {icon: 6});

                                } else if(data == '1') {
                                    
                                    window.location.href='/homes/login';

                                } else {

                                   layer.alert('购买成功', {icon: 6});

                                    var ids = data;

                                    //链接付款
                                    var but = $("<a href='{{url('/homes/piao?id=')}}"+ids+"'><button id='shop' class='btn btn-danger'>马上付款</button></a>");
                                    $('#goumai').after(but);
                                    $('#shop').css('margin-left','20px'); 
                                }
                                
                                zuos();    

                        })
                    }
                    
                }

            })


            //获取座位判断是否选中

            function zuos(){
                $.post('{{ url("/homes/shopseat_into/$id") }}',{_token:'{{ csrf_token() }}'},function(data){

                    // console.log(typeof data);
                   
                    for(var a in data){

                        //遍历已售票
                        $('#'+data[a]).removeClass('none');
                        $('#'+data[a]).addClass('curs');

                    };
                   
                },'json');

            }

            

}    
</script>


@endsection
