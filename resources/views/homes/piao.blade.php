@extends('homes.layout.moban')

@section('title','傻家伙')

<!-- <meta http-equiv="refresh" content="3; return redirect('/homes/index') /> -->

@section('content')

<style type="text/css">

.widget-buy-orderlist .wrap-content .order-list .item-tr .item-td {
    display: inline-block;
    vertical-align: middle;
}
.widget-buy-orderlist .wrap-content .order-list .item-tr .item-td.check {
    text-align: center;
    width: 60px;
}

.widget-buy-orderlist .wrap-content .order-list .item-tr .item-td.order-info .order-detail {
    display: inline-block;
    vertical-align: top;
    width: 442px;
}

.widget-buy-orderlist .wrap-content .order-list .item-tr .item-td.order-edit {
    width: 204px;
}

.widget-buy-orderlist .wrap-content .order-list .item-tr .item-td.order-edit .phone-eidt {
    margin: 10px 0 0 -4px;
}

.widget-buy-orderlist .wrap-content .order-list .item-tr .item-td.order-edit .phone-eidt span {
    color: #333;
    font-size: 24px;
}

.widget-buy-orderlist .wrap-content .order-list .item-tr .item-td.order-num .price {
    font-size: 24px;
    margin: 10px 0 0 -2px;
}

.widget-buy-orderlist .confirm {
    margin: -10px 0 101px;
}

.widget-buy-orderlist .confirm .total-money span {
    font-size: 24px;
}

.widget-buy-orderlist .wrap-content .cuttime-content {
  background-color: #00CCFF;
  margin-bottom: 30px;
  padding: 24px 30px 24px 42px;
}

</style>

<div class="widget-buy-orderlist">
    <h2 class="title font16 clearfix" style="padding-top:20px;padding-left:20px">
        确认订单信息
        <span class="fr font12 font-shadow">
            订单号：{{ $piao['num'] }}
            <input type="hidden" value="{{$piao['num']}}" id="input">
        </span>
    </h2>
    <div class="wrap-content">
    	<div class="cuttime-content nuomi-red">
			请在5分钟内完成付款，超时系统将自动释放已选座位
		</div>
        <ul class="order-list">
            <!-- 影片 -->
            <li class="item-tr">
                <label class="item-td check">
                </label>
                <div class="item-td order-info">
                    <div class="order-detail">
                        <p data-data="{&quot;movieId&quot;:95124}" data-url="/movie/detail" class="order-name">
                           <h3 id="name">{{ $film->filmname }}</h3> 
                        </p>
                        <p class="type-time font-shadow">
                            <span>
                                <!-- 国语&nbsp;&nbsp;2D -->
                            </span>
                        </p>
                        <ul class="threat-info font14">
                            <li data-data="{&quot;cinemaId&quot;:1019}" data-url="/cinema/detail"
                            class="cursor-pointer">
                                <span class="font-shadow" >
                                    影院：
                                </span>
                               <span id="cinema">{{ $cinema->cinema }}<span>
                                
                            </li>
                            <li>
                                <span class="font-shadow" >
                                    影厅：
                                </span>
                                {{ $room->roomname }}
                            </li>
                            <li>
                                <span class="font-shadow">
                                    场次：
                                </span>
                                
                                {{date('Y-m-d H:i:s', $show->time ) }}
                            </li>
                        </ul>
                        <ul class="seat font14">
                            <li>
                                <i>
                                </i>
                                {{ $seat['0'] }} 排 {{ $seat['1'] }} 座
                                
                                <em>
                                </em>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="item-td split-levline1">
                </div>
                <div class="item-td order-edit font-shadow font14">
                    接收取票码的手机号：
                    <p class="phone-eidt">
                        <span id="phoneNum">
                            {{ $user->phone }}
                        </span>
                    </p>
                </div>
                <div class="item-td split-levline1">
                </div>
                <div class="item-td order-num">
                    金额小计:
                    <p class="price">
                        ¥{{ $piao['price']}}.00
                    </p>
                </div>
            </li>
        </ul>
    </div>
    <div class="confirm font-shadow text-right" style="padding-right:20px">
    		        
	        <p class="total-money">
	            实际支付：
	            <span data-selector="totalPrice" id="price" class="nuomi-red">{{ $piao['price'] }}.00元</span>
	        </p>
	        <button data-selector="pay" id='fun' style="width:200px;font-size:20px; "  class="btn btn-info confirm-button back-red" >
		            确认并去支付
	        </button>
		
    </div>
</div>
@endsection


@section('js')
<script type="text/javascript">

	var price = $('#price').text();
	var cinema = $('#cinema').text();
	var name = $('#name').text();
    var id = $('#input').val();
    

	$('#fun').click(function(){

     layer.alert('请确认订单信息', {
        skin: 'layui-layer-molv' //样式类名  自定义样式
        ,closeBtn: 1    // 是否显示关闭按钮
        ,anim: 1 //动画类型
        ,btn: ['确认','返回'] //按钮
        ,icon: 6    // icon
        ,yes:function(){
            
		     $.get("{{url('/homes/money')}}",{price:price,cinema:cinema,name:name,id:id},function(data){
                    
                    if (data == 1) {

                        layer.msg('购票成功');
                        window.location.href="/homes/center";

                    } else {


                        layer.msg('此票已售出');


                    }

		     },'json');
           
        }
        ,btn2:function(){

            layer.msg('返回中')
            return back;

        }});
    });

    
</script>
@endsection