@extends('FilmAdmins.layout.index')

@section('title', '电影院座位图')

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
        padding-top: 18px;
    }
</style>
@section('content') 

<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>座位图</span>
    </div>
    <div class="mws-panel-body no-padding">
        <form class="mws-form">
            <div class="mws-form-block">

                 
            <div class="mws-form-row">
                <label class="mws-form-label"><h3>座位图</h3></label>
                <input type="hidden" id="x" value="{{ $data->hang }}"  name="hang">
                <input type="hidden" id="y"  value="{{ $data->lie }}" name="lie">
                 <br/>  
                <div class="mws-form-item"> 
                    <div id="seat-maps"></div>
                    <ul id="selected-seats">
                    </ul>
                </div>
            </div> 
            <br>
            </div></form>
            <div class="mws-button-row" id="xiugai"  >
                <button  class="btn btn-danger">购买</button>
                
            </div>
            <!-- <div id="legend"></div> -->
        
    </div>
</div>




@endsection
@section('js')      
<script>
//第一个座位号
var firstSeatLabel = 1;
//最后引入座位函数
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

    //获取行和列
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

            //不可选座位单击无效
            $(this).click(function(){
                $(this).removeClass('none');
            });
        }
    })

    zuos();

    //购票
    $('button').click(function(){

                var info = [];
                $('.none').each(function(){

                    //获取座位号
                    var zuo = $(this).attr('id');

                    info.push(zuo);

                })
                
                //将数组转化为字符串
                var into = info.join('#');

                if(!into){
                    // alert('请选择电影票!!');
                    layer.alert('请选择电影票!!', {icon: 6});
 
                }else{

                    //定义正则
                    var reg = /^\w{3,5}$/;
                    //执行验证
                    var x = reg.exec(into);
                
                    if(!x){
                        
                        // alert('抱歉!一次只能买一张!');
                        layer.alert('抱歉!一次只能买一张!', {icon: 6});
                    }else{

                        //发送ajax      into = '4_5'
                        $.post('{{ url("/FilmAdmins/ticket/shopseat/$id") }}',{_token:'{{ csrf_token() }}', zuo:into},function(data){

                                layer.alert(data, {icon: 6});

                                //调用已购买函数
                                zuos();

                        })
                    }
                    
                }

            })


            //获取座位判断是否选中

            function zuos(){
                $.post('{{ url("/FilmAdmins/ticket/shopseat_into/$id") }}',{_token:'{{ csrf_token() }}'},function(data){

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
