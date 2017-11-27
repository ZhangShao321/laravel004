@extends('homes.layout.moban')

@section('title','电影列表页')

@section('content')

<!-- heading-banner start -->
<div class="heading-banner">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="{{url('/homes/index')}}">首页</a></li>
					<li class="active">电影列表</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- heading-banner end -->

<!-- content start -->
<div class="shop-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <!-- 影片分类 start -->
                <aside class="widget widget-categories">
                    <h3 class="sidebar-title">
                        影片分类
                    </h3>
                    <ul class="sidebar-menu">

                    @foreach($type as $aa=>$bb)
                        <li>
                            <a href="{{url('/homes/type?id=').$bb->id}}">
                                {{ $bb->tname }}
                            </a>
                            <span class="count">
                              ({{ $bb->num }}) 
                            </span>
                        </li>
                    @endforeach
                        
                    </ul>
                </aside>
                <!-- 影片分类 end -->

                <!-- 影片排行 start -->
                <aside class="widget filter-by">
                    <h3 class="sidebar-title">
                        电影排行榜
                    </h3>
                    <ul class="sidebar-menu">
                        @foreach($res1 as $k=>$v)
                        <li>
                            <a href="{{url('/homes/filmdetail?id=').$v->id}}">
                                {{ $v->filmname }}
                            </a>
                            <span class="count">
                                售票:{{ $v->shownum }}
                            </span>
                        </li>
                        @endforeach
                    </ul>
                </aside>
                <!-- 影片排行 end -->
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <!-- 影片列表 start-->
                <div class="shop-content">
                    <ul class="shop-tab" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
                                <i class="fa fa-list">
                                </i>
                            </a>
                        </li>
                    </ul>
                    <div class="show-result">
                        <p>
                            精彩不间断
                        </p>
                    </div>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="profile">
                            <div class="row shop-list">
                                @foreach($res as $k=>$v)
                                <div class="col-md-12">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="{{url('/homes/filmdetail?id=').$v->id}}">
                                                
                                                <img style="width:300px;height:350px" class="primary-img" src="{{asset('http://ozspa9a4f.bkt.clouddn.com/Uplodes/'. $v->filepic) }}" alt="" />
                                                <img style="width:300px;height:350px" class="secondary-img" src="{{asset('http://ozspa9a4f.bkt.clouddn.com/Uplodes/'. $v->filepic) }}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-info">
                                            <h3>
                                                <a href="{{url('/homes/filmdetail?id=').$v->id}}">
                                                    {{$v->filmname}}
                                                </a>
                                            </h3>
                                            <div class="pro-price">
                                                <span class="normal">
                                                    导演:{{$v->director}}
                                                </span>
                                            </div>
                                            <div class="pro-price">
                                                <span class="normal">
                                                    ￥{{$v->price}}
                                                </span>
                                            </div>
                                            <div class="product-desc">
                                                <p>
                                                    {{$v->summary}}
                                                </p>
                                            </div>
                                            <div class="product-action">
                                                <div class="pro-button-top">
                                                    <a href="{{url('/homes/filmdetail?id=').$v->id}}">
                                                        详情
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                 <!-- 影片列表 end-->

                <div class="shop-pagination">
                {!! $res->render() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content end -->
@endsection
