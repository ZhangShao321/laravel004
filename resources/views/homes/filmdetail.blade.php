@extends('homes.layout.moban')

@section('title','电影详情页')

@section('content')


<!-- heading-banner start -->
<div class="heading-banner">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="{{url('/homes/index')}}">首页</a></li>
					<li><a href="{{url('/homes/filmlist')}}">电影列表</a></li>
					<li class="active">电影详情</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- heading-banner end -->


<!-- 电影详情 start -->

<div class="single-product-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="single-pro-tab-content">

                            @foreach($res as $k=>$v)
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="home">
									<a href="#">
										<img src="{{asset($v->filepic) }}" alt="" /></a>
                                </div>	
							</div>
                            @endforeach
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12 shop-list">
						<div class="product-info product-single">

							<h3><a href="single-product.html">{{$v->filmname}}</a></h3>
							<div class="pro-price">
								<span class="normal">￥{{$v->price}}</span> 
							</div>
							<hr class="page-divider">

							<div class="product-desc">
								<p>导演：{{$v->director}}</p>
								<p>主演：{{$v->protagonist}}</p>
								<p>电影时长：{{$v->filmtime}}</p>
								<p>上映时间：{{$v->showtime}}</p>
								<p>影片简介：{{$v->summary}}</p>
							</div>
							<hr class="page-divider">
							
							<hr class="page-divider small">

							@endforeach
						</div>
					</div>
				</div>
			</div>
        </div>
   </div> 
</div>
 <!-- 电影详情 end -->

<!-- 上映影院 start -->
<div class="service-area pad-top">
	<div class="container">
		<div class="row">
			<!-- single-service start -->
			<div class="col-lg-4 col-md-4 col-sm-6">
				<div class="single-service">
					<div class="service-icon">
						<i class="fa fa-money" ></i>
					</div>
					<div class="service-text">
						<h2>
							上映电影院</h2>
						<h3><a href="#">选座购票</a></h3>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- 上映影院 end -->

<!-- 底部横条 start -->
<div class="subscribe-area">
	<div class="container">
		<div class="subscribe-title">
			<h3>
				<span>傻家伙</span>给你最好的视觉享受</h3>
			<p>梦幻时空的魔幻快车给你带来的刺激体验。３D、４D、5D、6D、7D、nD动感影院，海市蜃楼般如真如幻。</p>
			
		</div>
	</div>
</div>
<!-- 底部横条 end -->

@endsection

