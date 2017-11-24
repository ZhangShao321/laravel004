@extends('homes.layout.moban')

@section('title','个人订单')

@section('content')

<!-- HOME SLIDER -->
 
<div class="heading-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li><a href="{{url('/homes/index')}}">首页</a></li>
                    
                    <li class="active">个人订单</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- heading-banner start -->
<form class="form-horizontal" action="{{url('/homes/insert')}}" method="post" id="box" enctype="multipart/form-data">
    <fieldset>
    @foreach($res1 as $ck=>$cv)
    <div class="form-group">
        <label for="cinema" class="col-sm-2 control-label">
             电影院
        </label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="inputEmail3" value="{{$cv->cinema}}"   required>
        </div>
    </div>
    @endforeach

    @foreach($res3 as $fk=>$fv) 
    <div class="form-group">
        <label for="cinema" class="col-sm-2 control-label">
             电影
        </label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="inputEmail3" value="{{$fv->filmname}}"  required>
        </div>
    </div>
    @endforeach
    
    @foreach($res2 as $rk=>$rv)
    <div class="form-group">
        <label for="cinema" class="col-sm-2 control-label">
             影厅
        </label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="inputEmail3" value="{{$rv->roomname}}"  required>
        </div>
    </div>
    <div class="form-group">
        <label for="cinema" class="col-sm-2 control-label">
             类型
        </label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="inputEmail3" value="{{$rv->roomtype}}"  required>
        </div>
    </div>
    @endforeach

    @foreach($res4 as $sk=>$sv)
     
    <div class="form-group">
        <label for="cinema" class="col-sm-2 control-label">
             放映时间
        </label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="inputEmail3" value="{{$sv->time}}"  required>
        </div>
    </div>
    @endforeach

    @foreach($res as $k=>$v)

    <div class="form-group">
        <label for="phone" class="col-sm-2 control-label">
            排_座
        </label>
        <div class="col-sm-5">
            <input type="phone" class="form-control" id="inputPassword3" value="{{$v->seat}}"  required>
        </div>
    </div>
     
    <div class="form-group">
        <label for="city" class="col-sm-2 control-label">
            价格
        </label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="inputPassword3" value="{{$v->price}}"  required>
        </div>
    </div>
   

    <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">
           购票时间
        </label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="inputPassword3" value="{{$v->time}}"  required>
        </div>
        {{ csrf_field() }}
    </div>
     @endforeach
    


    </fieldset>
</form>


@endsection

 
