@extends('homes.layout.moban')

@section('title','电影详情页')

@section('content')

<<<<<<< HEAD
<!-- HOME SLIDER -->
=======
>>>>>>> d9a021112ec5828c4de4b5d148256e6e902a16a0
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
<<<<<<< HEAD
<!-- single-product-area start -->
=======

<!-- 电影详情 start -->
>>>>>>> d9a021112ec5828c4de4b5d148256e6e902a16a0
<div class="single-product-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="single-pro-tab-content">
<<<<<<< HEAD
							<!-- Tab panes -->
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="home">
									<a href="#">
										<img src="img/product/1.jpg" alt="" /></a></div>
								<div role="tabpanel" class="tab-pane" id="profile">
									<a href="#">
										<img src="img/product/2.jpg" alt="" /></a></div>
								<div role="tabpanel" class="tab-pane" id="messages">
									<a href="#">
										<img src="img/product/3.jpg" alt="" /></a></div>
								<div role="tabpanel" class="tab-pane" id="settings">
									<a href="#">
										<img src="img/product/4.jpg" alt="" /></a></div>
							</div>
							
=======
                            @foreach($res as $k=>$v)
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="home">
									<a href="#">
										<img src="{{asset($v->filepic) }}" alt="" /></a>
                                </div>	
							</div>
>>>>>>> d9a021112ec5828c4de4b5d148256e6e902a16a0
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12 shop-list">
						<div class="product-info product-single">
<<<<<<< HEAD
							<h3>
								<a href="single-product.html">电影名字</a></h3>
							<div class="pro-rating">
								<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
									class="fa fa-star"></i><i class="fa fa-star"></i>
								
							</div>
							<div class="pro-price">
								<span class="normal">￥50</span> 
							</div>
							<hr class="page-divider">
							<div class="product-desc">
								<p>导演：</p>
								<p>主演：</p>
								<p>电影时长：</p>
								<p>上映时间：</p>
								<p>影片简介：</p>
							</div>
							<hr class="page-divider">
							
							<div class="product-action">
								<form action="#">
								<div class="cart-plus-minus">
									<input type="text" value="1" /></div>
								</form>
								<div class="pro-button-top">
									<a href="#">购票</a>
								</div>
								
							</div>
							<hr class="page-divider small">
							
							
						</div>
					</div>
				</div>
				<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="product-tabs">
            <div>
                <!-- Nav tabs -->
                <ul class="pro-details-tab" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#tab-desc" aria-controls="tab-desc" role="tab" data-toggle="tab">
                            Description
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#page-comments" aria-controls="page-comments" role="tab" data-toggle="tab">
                            Reviews (1)
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="tab-desc">
                        <div class="product-tab-desc">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla
                                augue nec est tristique auctor. Donec non est at libero vulputate rutrum.
                                Morbi ornare lectus quis justo gravida semper. Nulla tellus mi, vulputate
                                adipiscing cursus eu, suscipit id nulla.
                            </p>
                            <p>
                                Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem,
                                quis fermentum turpis eros eget velit. Donec ac tempus ante. Fusce ultricies
                                massa massa. Fusce aliquam, purus eget sagittis vulputate, sapien libero
                                hendrerit est, sed commodo augue nisi non neque. Lorem ipsum dolor sit
                                amet, consectetur adipiscing elit. Sed tempor, lorem et placerat vestibulum,
                                metus nisi posuere nisl, in accumsan elit odio quis mi. Cras neque metus,
                                consequat et blandit et, luctus a nunc. Etiam gravida vehicula tellus,
                                in imperdiet ligula euismod eget.
                            </p>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="page-comments">
                        <div class="product-tab-desc">
                            <div class="product-page-comments">
                                <h2>
                                    1 review for Integer consequat ante lectus
                                </h2>
                                <ul>
                                    <li>
                                        <div class="product-comments">
                                            <img src="img/author.jpg" alt="" />
                                            <div class="product-comments-content">
                                                <p>
                                                    <strong>
                                                        admin
                                                    </strong>
                                                    -
                                                    <span>
                                                        March 7, 2015:
                                                    </span>
                                                    <span class="pro-comments-rating">
                                                        <i class="fa fa-star">
                                                        </i>
                                                        <i class="fa fa-star">
                                                        </i>
                                                        <i class="fa fa-star">
                                                        </i>
                                                        <i class="fa fa-star">
                                                        </i>
                                                    </span>
                                                </p>
                                                <div class="desc">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla
                                                    augue nec est tristique auctor. Donec non est at libero vulputate rutrum.
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="review-form-wrapper">
                                    <h3>
                                        Add a review
                                    </h3>
                                    <form action="#">
                                        <input type="text" placeholder="your name" />
                                        <input type="email" placeholder="your email" />
                                        <div class="your-rating">
                                            <h5>
                                                Your Rating
                                            </h5>
                                            <span>
                                                <a href="#">
                                                    <i class="fa fa-star">
                                                    </i>
                                                </a>
                                                <a href="#">
                                                    <i class="fa fa-star">
                                                    </i>
                                                </a>
                                            </span>
                                            <span>
                                                <a href="#">
                                                    <i class="fa fa-star">
                                                    </i>
                                                </a>
                                                <a href="#">
                                                    <i class="fa fa-star">
                                                    </i>
                                                </a>
                                                <a href="#">
                                                    <i class="fa fa-star">
                                                    </i>
                                                </a>
                                            </span>
                                            <span>
                                                <a href="#">
                                                    <i class="fa fa-star">
                                                    </i>
                                                </a>
                                                <a href="#">
                                                    <i class="fa fa-star">
                                                    </i>
                                                </a>
                                                <a href="#">
                                                    <i class="fa fa-star">
                                                    </i>
                                                </a>
                                                <a href="#">
                                                    <i class="fa fa-star">
                                                    </i>
                                                </a>
                                            </span>
                                            <span>
                                                <a href="#">
                                                    <i class="fa fa-star">
                                                    </i>
                                                </a>
                                                <a href="#">
                                                    <i class="fa fa-star">
                                                    </i>
                                                </a>
                                                <a href="#">
                                                    <i class="fa fa-star">
                                                    </i>
                                                </a>
                                                <a href="#">
                                                    <i class="fa fa-star">
                                                    </i>
                                                </a>
                                                <a href="#">
                                                    <i class="fa fa-star">
                                                    </i>
                                                </a>
                                            </span>
                                        </div>
                                        <textarea id="product-message" cols="30" rows="10" placeholder="Your Rating">
                                        </textarea>
                                        <input type="submit" value="submit" />
                                    </form>
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
<!-- single-product-area end -->
=======
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
>>>>>>> d9a021112ec5828c4de4b5d148256e6e902a16a0
@endsection

