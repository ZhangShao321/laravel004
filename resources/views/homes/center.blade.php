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
    <div class="form-group">
        <label for="cinema" class="col-sm-2 control-label">
             昵称
        </label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="inputEmail3" value="" name="uname" required>
        </div>
    </div>
     
    <div class="form-group">
        <label for="phone" class="col-sm-2 control-label">
            影厅
        </label>
        <div class="col-sm-5">
            <input type="phone" class="form-control" id="inputPassword3" value="" name="qq" required>
        </div>
    </div>
     
    <div class="form-group">
        <label for="city" class="col-sm-2 control-label">
            价格
        </label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="inputPassword3" value="" name="email" required>
        </div>
    </div>
   

    <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">
           放映时间
        </label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="inputPassword3" value="" name="email" required>
        </div>
        {{ csrf_field() }}
    </div>

    </fieldset>
</form>

@endsection

 
