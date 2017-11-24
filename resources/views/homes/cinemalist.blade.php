@extends('homes.layout.moban')

@section('title','电影院列表页')

@section('content')

<!-- heading-banner start -->
<div class="heading-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li><a href="{{url('/homes/index')}}">首页</a></li>
                    <li class="active">电影院列表</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- heading-banner end -->

<!-- 服务宗旨 start -->
<div class="about-us-area">
    <div class="container">
        <div class="row">
            <!-- about-img start -->
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="about-img">
                    <img src="/homes/img/fuwu.jpg" alt="" />
                </div>
            </div>
            <!-- about-img end -->
            <!-- about-text start -->
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="about-text">
                    <h2> 服务 <span>宗旨</span></h2>
                    <h2>
                        微笑——微笑挂在脸上，服务记在心里。</h2>
                    <h2>
                        诚信——坚持诚信理念，开展优质服务。
                    </h2>
                    <h2>
                        效率——创新服务理念，提升服务效率。
                   </h2>
                    <h2>
                       专业——以专业为导向，以服务为宗旨。
                    </h2>
                    <hr class="page-divider small">
                    <h2> 服务 <span>理念</span></h2>
                    <h2>
                       让电影融入生活，让生活充满快乐。
                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 服务宗旨 end -->

<!-- 中间图 start -->
<div class="about-counter-area">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="single-counter">
                    <i class="fa fa-users"></i>
                    <h3 class="about-counter">
                        150000</h3>
                    <h4 style="color:white">观影人数</h4>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="single-counter">
                    <i class="fa fa-trophy"></i>
                    <h3 class="about-counter">
                        1</h3>
                    <h4 style="color:white">影院排行</h4>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="single-counter">
                    <i class="fa fa-thumbs-up"></i>
                    <h3 class="about-counter">
                        43960</h3>
                    <h4 style="color:white">好评</h4>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="single-counter">
                    <i class="fa fa-home"></i>
                    <h3 class="about-counter">
                        5430</h3>
                    <h4 style="color:white">影院数量</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 中间图 end -->

<!-- 电影院列表 start -->
<div class="about-team-area">
    <div class="container">
        <div class="row">
            @foreach($res as $k => $v)
            <div class="col-md-3 col-sm-4">
                <div class="single-about-team">
                    <a href="{{url('/homes/cinemadetail?id=').$v->id}}">
                    <div class="about-team-img">
                        <img src="{{asset('http://ozspa9a4f.bkt.clouddn.com/Uplodes/'. $v->clogo) }}" style="width:200px;height:200px" alt="" />
                    </div>
                    <div class="about-team-info">
                        <h3>
                            {{ $v->cinema}}</h3>
                    </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- 电影院列表 end -->

@endsection
