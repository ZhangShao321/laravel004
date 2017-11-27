@extends('homes.layout.moban')

@section('title','傻家伙')

@section('content')

<!-- 轮播图 start -->
<div style="width:auth" class="slider-wrap">
	<div class="fullwidthbanner-container">
		<div class="fullwidthbanner">
			<ul>
				@foreach($res1 as $k => $v)
               
				<li data-transition="fade" data-slotamount="7" data-masterspeed="300" data-saveperformance="on">
					<!--MAIN IMAE-->
                   
					<img src="http://ozspa9a4f.bkt.clouddn.com/Uplodes/{{ $v->picname }}" alt="" data-bgposition="center top" data-duration="" data-ease="Power0.easeInOut" data-bgfit="cover" data-bgrepeat="no-repeat"  />
					<!-- LAYER NR. -->
					<div class="tp-caption skewfromrightshort skewtorightshort tp-resizeme" data-x="center"
						data-hoffset="0" data-y="center" data-voffset="-150" data-speed="500" data-start="500"
						data-easing="Power4.easeOut" data-splitin="none" data-splitout="none" data-elementdelay="0.01"
						data-endelementdelay="0.1" data-endspeed="500" data-endeasing="Power4.easeIn"
						style="z-index: 5; color: #fff; text-align: left !important; line-height: 100%;
						font-size: 60px; letter-spacing: 6px; text-transform: uppercase; font-weight: 900;">
						{{$v->fname}}
					</div>
					<!-- LAYERS 3-->
					<div class="tp-caption skewfromrightshort skewtorightshort tp-resizeme splitted"
						data-x="center" data-hoffset="0" data-y="center" data-voffset="-30" data-speed="500"
						data-start="1300" data-easing="Power4.easeInOut" data-splitin="chars" data-splitout="none"
						data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="500" style="z-index: 4;
						font-size: 80px; line-height: 50px; text-transform: none; font-weight: 400; letter-spacing: 4px;
						color:rgb(255,0,0); text-align: right !important; max-width: auto; max-height: auto;
						white-space: nowrap;">
						正在热映中。。。。。
					</div>
					<div class="tp-caption tp-fade fadeout tp-resizeme" data-x="center" data-hoffset="0"
						data-y="center" data-voffset="75" data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
						data-speed="500" data-start="1500" data-easing="Power3.easeInOut" data-splitin="none"
						data-splitout="none" data-ele	mentdelay="0.05" data-endelementdelay="0.1" data-endspeed="500"
						style="z-index: 7;">
						
					</div>
				</li>

				@endforeach
			</ul>
		</div>
	</div>
</div>
<!-- 轮播图 end -->

<!-- 热映电影 start -->
<div class="banner-area">
    <div class="container">
        <div class="row">
            <div class="section-title text-center">
                
                <h2 style="color:red;margin:3px"> 热 映 电 影 </h2>
                
            </div>
            @foreach($res as $k=>$v)
            <div class="col-lg-4 col-md-4 col-sm-4">
                <a href="{{url('/homes/filmdetail?id=').$v->id}}">
                    <div class="single-banner">
                        <img src="{{asset('http://ozspa9a4f.bkt.clouddn.com/Uplodes/'. $v->filepic) }}
                        " style="width:360px;height:420px" alt="" />
                        <div class="banner-details">
                            <div class="mask">
                                <p>
                                    {{ $v->summary}}
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="service-area pad-top">
	<div class="container">
		<div class="row">
			@foreach($res as $k=>$v)
			<div class="col-lg-4 col-md-4 col-sm-6">
				<a href="{{url('/homes/filmdetail?id=').$v->id}}">
					<div class="single-service">
						<div class="service-icon">
							<i class="fa fa-file"></i>
						</div>
						<div class="service-text">
							<h2>
								{{ $v->filmname}}</h2>
							<p>
								导演:{{ $v->director}}</p>
						</div>
					</div>
				</a>
			</div>
			@endforeach
		</div>
	</div>
</div>
<!-- 热映电影 end -->

<!-- 即将上映 start -->
<div class="features-area pad-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center">
                   <h2 style="color:red;margin:3px"> 即 将 上 映 </h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="product-tab">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <div class="row">
                                <div class="product-curosel">
                                    @foreach($res2 as $k=>$v)
                                    <div class="col-lg-12">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="{{url('/homes/filmdetail?id=').$v->id}}">
                                                    <img class="primary-img" src="{{asset('http://ozspa9a4f.bkt.clouddn.com/Uplodes/'. $v->filepic) }}
                                                    " style="width:300px;height:350px" alt="" />
                                                    <img class="secondary-img" src="{{asset('http://ozspa9a4f.bkt.clouddn.com/Uplodes/'. $v->filepic) }}
                                                    " style="width:300px;height:350px" alt="" />
                                                </a>
                                                <span class="sale">
                                                    敬请期待
                                                </span>
                                                <div class="product-action">
                                                    <div class="pro-button-top">
                                                        <a href="{{url('/homes/filmdetail?id=').$v->id}}">
                                                            查看详情
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <h3>
                                                    <a href="{{url('/homes/filmdetail?id=').$v->id}}">
                                                       {{$v->filmname}}
                                                    </a>
                                                </h3>
                                                <div class="pro-price">
                                                    <span class="normal">
                                                        ￥{{$v->price}}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 即将上映 end -->

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
