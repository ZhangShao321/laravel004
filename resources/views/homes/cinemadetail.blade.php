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
                @foreach($res as $k => $v)
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="single-pro-tab-content">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="home">
                                    <a href="#">
                                        <img src="{{asset('http://ozspa9a4f.bkt.clouddn.com/Uplodes/'. $v->clogo) }}" style="width:450px;height:550px" alt="" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 shop-list">
                        <div class="product-info product-single">
                            <h1>
                                    {{$v->cinema}}
                            </h1>
                            <hr class="page-divider">
                            <h3>
                                    联系电话：{{$v->phone}}
                            </h3>
                            <hr class="page-divider">
                            <div class="product-desc">
                                @foreach($res1 as $k => $v)
                                <p>
                                    地址：{{$v->city}}{{$v->area}}{{$v->address}}
                                </p>
                                @endforeach
                            </div>
                            <hr class="page-divider">
                            <div class="product-desc">
                                <p>
                                    儿童票：1.3米以下儿童免票无座,1.3米以上儿童半价观影
                                </p>
                            </div>
                            <hr class="page-divider">
                            <div class="product-desc">
                                <p>
                                    停车：VIP免费停车
                                </p>
                            </div>
                            <hr class="page-divider">
                            <div class="product-desc">
                                <p>
                                    3D影院：免押金
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
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
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <div class="row">
                                <div class="product-curosel">
                                 @foreach($res2 as $k=>$v)
                                    <div class="col-lg-12">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="{{url('/homes/dingpiao?id=').$v->id}}">
                                                    <img class="primary-img" src="http://ozspa9a4f.bkt.clouddn.com/Uplodes/{{ $v->filepic }}" style="width:250px;height:300px" alt="" />
                                                    <img class="secondary-img" src="http://ozspa9a4f.bkt.clouddn.com/Uplodes/{{ $v->filepic }}" style="width:250px;height:300px" alt="" />
                                                </a>
                                                <span class="sale">
                                                    精品
                                                </span>
                                                <div class="product-action">
                                                    <div class="pro-button-top">
                                                        <a href="{{url('/homes/dingpiao?id=').$v->id}}">
                                                            购票
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <h3>
                                                    <a href="{{url('/homes/dingpiao?id=').$v->id}}">
                                                        {{$v->filmname}}
                                                    </a>
                                                </h3>
                                                <div class="pro-price">
                                                    <span class="normal">
                                                        场次:{{ date('Y-m-d H:i:s',$v->time) }} | ￥{{$v->price}}
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
<!-- 上映电影 end -->	

@endsection

