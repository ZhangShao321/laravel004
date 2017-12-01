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
                           
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="home">
									
										<img src="{{asset('http://ozspa9a4f.bkt.clouddn.com/Uplodes/'. $aaa->filepic) }}" style="width:500px;height:600px" alt="" />
                                </div>	
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12 shop-list">
						<div class="product-info product-single">
							<h3>{{$aaa->filmname}}</h3>
							<div class="pro-price">
								<span class="normal">￥{{$aaa->price}}</span> 
							</div>
							<hr class="page-divider">

							<div class="product-desc">
								<p>导演：{{$aaa->director}}</p>
								<p>主演：{{$aaa->protagonist}}</p>
								<p>电影时长：{{$aaa->filmtime}} 分钟</p>
								<p>上映时间：{{date('Y-m-d H:i:s',$aaa->showtime)}}</p>
								<p>影片简介：{{$aaa->summary}}</p>
							</div>
							<hr class="page-divider">
							
							<hr class="page-divider small">
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
			@foreach($bbb as $k=>$v)
			<div style="margin-top:20px" class="col-lg-4 col-md-4 col-sm-6">
				<div class="single-service">
					<div class="service-icon">
						<i class="fa fa-money"></i>
					</div>
					<div class="service-text">
						<h2>影院：{{$v->cinema}}</h2>
						<h5>{{$v->city}}{{$v->area}}{{$v->address}}</h5>
						<a href="{{url('/homes/dingpiao?id=').$v->id}}"><p>上映时间:{{date('Y-m-d H:i:s',$v->time)}}</p><button class="btn btn-danger">选座购票</button></a>	

					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>

<!-- 上映影院 end -->


@endsection

