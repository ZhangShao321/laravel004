@extends('homes.layout.del')

@section('title','充值中心')

@section('content')
    <form class="am-form am-form-horizontal" action="{{url('/homes/adds')}}"  method="post" enctype="multipart/form-data">
                                     
        <div class="am-form-group">
        <label for="user-email" class="am-form-label">充值</label>
            <div class="am-form-content">
            <input type="text" name="money" value=""/>    
                    
            </div>
        </div>
                            
        {{ csrf_field() }}
        <div class="info-btn">
                                     
            <button type="submit" id="sub" class="am-btn am-btn-danger">确定充值</button>
                                    

        </div>

    </form>
@endsection
