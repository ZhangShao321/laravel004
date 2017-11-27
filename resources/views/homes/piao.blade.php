@extends('homes.layout.moban')

@section('title','傻家伙')

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

</style>

<div class="widget-buy-orderlist">
    <h2 class="title font16 clearfix" style="padding-top:20px;padding-left:20px">
        确认订单信息
        <span class="fr font12 font-shadow">
            订单号：138212978247467008
        </span>
    </h2>
    <div class="wrap-content">
        <ul class="order-list">
            <!-- 影片 -->
            <li class="item-tr">
                <label class="item-td check">
                </label>
                <div class="item-td order-info">
                    <!--<a class="movie-pic" href="javascript:;" target="_blank">
                    <img src="" alt="">
                    </a>-->
                    <div class="order-detail">
                        <p data-data="{&quot;movieId&quot;:95124}" data-url="/movie/detail" class="order-name">
                            引爆者
                        </p>
                        <p class="type-time font-shadow">
                            <span>
                                国语&nbsp;&nbsp;2D
                            </span>
                            <!--<span class="last">1511526000</span>-->
                        </p>
                        <ul class="threat-info font14">
                            <li data-data="{&quot;cinemaId&quot;:1019}" data-url="/cinema/detail"
                            class="cursor-pointer">
                                <span class="font-shadow">
                                    影院：
                                </span>
                                长春红旗街万达广场店
                            </li>
                            <li>
                                <span class="font-shadow">
                                    影厅：
                                </span>
                                2号厅
                            </li>
                            <li>
                                <span class="font-shadow">
                                    场次：
                                </span>
                                11月24号&nbsp;&nbsp;&nbsp; 周五&nbsp;&nbsp;&nbsp; 20:20
                            </li>
                        </ul>
                        <ul class="seat font14">
                            <li>
                                <i>
                                </i>
                                4排7座
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
                            15738828985
                        </span>
                    </p>
                    <p class="phone-eidt-in hide">
                        <input autocomplete="off" value="" placeholder="请输入接受取票码的手机号" class="group-input box-sizing font12"
                        data-selector="edit-phone-inp">
                        <a data-selector="edit-phone-comfirm" href="javascript:;" class="confirm-but box-sizing active">
                            确认
                        </a>
                    </p>
                </div>
                <div class="item-td split-levline1">
                </div>
                <div class="item-td order-num">
                    金额小计:
                    <p class="price">
                        ¥38.50
                    </p>
                </div>
                <!--<div class="split-hozline"></div>-->
            </li>
            <!-- 衍生品 -->
        </ul>
    </div>
    <div class="confirm font-shadow text-right" style="padding-right:20px">
        <p class="total-money">
            实际支付：
            <span data-selector="totalPrice" class="nuomi-red">
                38.50元
            </span>
        </p>
        <a data-selector="pay" style="width:200px;font-size:20px; "  href="javascript:;" class="btn btn-info confirm-button back-red" >
	            确认并去支付
        </a>
    </div>
</div>



@endsection
