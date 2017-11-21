@extends('homes.layout.moban')

@section('title','电影院详情页')

@section('content')

<!-- heading-banner start -->
<div class="heading-banner">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="{{url('/homes/index')}}">首页</a></li>
					<li><a href="{{url('/homes/cinemalist')}}">电影院列表</a></li>
					<li class="active">电影院详情</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- heading-banner end -->


<!-- 电影院详情 start -->
<div class="single-product-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="single-pro-tab-content">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="home">
                                    <a href="#">
                                        <img src="img/product/1.jpg" alt="" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 shop-list">
                        <div class="product-info product-single">
                            <h3>
                                <a href="single-product.html">
                                    电影院名字
                                </a>
                            </h3>
                            <div class="pro-rating">
                                <i class="fa fa-star">
                                </i>
                                <i class="fa fa-star">
                                </i>
                                <i class="fa fa-star">
                                </i>
                                <i class="fa fa-star">
                                </i>
                                <i class="fa fa-star">
                                </i>
                            </div>
                            <hr class="page-divider">
                            <div class="product-desc">
                                <p>
                                    地址：
                                </p>
                                <ul>
                                    <li>
                                        - Cras tristique neque a mauris volutpat, eget sodales neque elementum.
                                    </li>
                                    <li>
                                        - Vestibulum iaculis velit sed dolor suscipit pretium.
                                    </li>
                                    <li>
                                        - Etiam mattis risus id leo imperdiet tincidunt.
                                    </li>
                                </ul>
                            </div>
                            <hr class="page-divider">
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
<!-- 电影院详情 end -->


<!-- 上映电影 start -->
<div class="features-area pad-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <h3>
                        上映电影
                    </h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="product-tab">
                    <!-- Nav tabs -->
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <div class="row">
                                <div class="product-curosel">
                                    <!-- single-product start -->
                                    <div class="col-lg-12">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img" src="/homes/img/product/1.jpg" alt="" />
                                                    <img class="secondary-img" src="/homes/img/product/2.jpg" alt="" />
                                                </a>
                                                <span class="sale">
                                                    精品
                                                </span>
                                                <div class="product-action">
                                                    <div class="pro-button-top">
                                                        <a href="#">
                                                            查看详情
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <h3>
                                                    <a href="single-product.html">
                                                        电影名字
                                                    </a>
                                                </h3>
                                                <div class="pro-price">
                                                    <span class="normal">
                                                        ￥50
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 上映电影 end -->			

@endsection

