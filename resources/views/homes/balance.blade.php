@extends('homes.layout.del')

@section('title','余额')

@section('content')
    <form class="am-form am-form-horizontal" action=""  method="post" enctype="multipart/form-data">
                                    
        <div class="am-form-group">
            <label for="user-email" class="am-form-label">余额:</label>
            <div class="am-form-content">
                <input type="text" name="money" value="{{$res->umoney}}元"/>    
                    
            </div>
        </div>

    </form>

@endsection