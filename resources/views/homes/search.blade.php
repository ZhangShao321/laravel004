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
					<li class="active">搜索结果</li>
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
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <!-- 影片列表 start-->
                <div class="shop-content">                   
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="profile">
                            <div id="cont" class="row shop-list">

                                @foreach($res as $k=>$v)
                                <div class="col-md-12">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="{{url('/homes/filmdetail?id=').$v->id}}">
                                                <img class="primary-img" src="{{asset('http://ozspa9a4f.bkt.clouddn.com/Uplodes/'. $v->filepic) }}" style="width:300px;height:350px" alt="" />
                                                <img class="secondary-img" src="{{asset('http://ozspa9a4f.bkt.clouddn.com/Uplodes/'. $v->filepic) }}" style="width:300px;height:350px" alt="" />
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
                                                    均价：￥{{$v->price}}
                                                </span>
                                            </div>
                                            <div class="product-desc">
                                                <p id="p">
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
                                
                                <h2 align="center">{{ $aaaa }}</h2>
                                
                            </div>
                        </div>
                    </div>
                </div>
                 <!-- 影片列表 end-->
                 <div class="shop-pagination">
                    {!!$res->appends($request->all())->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content end -->
@endsection

@section('js')
<script>
    
    
</script>
@endsection
