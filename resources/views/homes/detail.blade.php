@extends('homes.layout.del')

@section('title','个人中心')

@section('content')
    <?php
        $uid = session('uid');
        $user = DB::table('user')->where('id',$uid)->first();
        $re = DB::table('userDetail')->where('uid',$uid)->first();
                            
    ?>
    <form class="am-form am-form-horizontal" action="{{url('/homes/update/'.$re->id)}}"  method="post" enctype="multipart/form-data">
        <div class="am-form-group">
            <label for="user-name2" class="am-form-label">昵称</label>
            <div class="am-form-content">
                <input type="text" id="user-name2" name="nickName" value="{{$re->nickName}}" placeholder="nickname">
                <small>昵称长度不能超过40个汉字</small>
            </div>
        </div>

        <div class="am-form-group">
            <label class="am-form-label">性别</label>
            <div class="am-form-content sex">
                <label class="am-radio-inline">
                    <input type="radio" name="sex" @if($re->sex == 'm') checked @endif value="m" data-am-ucheck> 男
                </label>
                <label class="am-radio-inline">
                    <input type="radio" name="sex" @if($re->sex == 'w') checked @endif value="w" data-am-ucheck> 女
                </label>
                <label class="am-radio-inline">
                    <input type="radio" name="sex" @if($re->sex == 'x') checked @endif value="x" data-am-ucheck> 保密
                </label>
            </div>
        </div>
                                    
        <div class="am-form-group">
            <label for="user-email" class="am-form-label">电子邮件</label>
            <div class="am-form-content">
                <input id="user-email" placeholder="Email" type="email" name="email" value="{{$re->email}}">

            </div>
        </div>
        <div class="am-form-group">
            <label for="user-email" class="am-form-label">QQ</label>
                <div class="am-form-content">
                    <input id="user-email" placeholder="QQ" type="text" name="qq" value="{{$re->qq}}">

                </div>
        </div>
                            
        <div class="am-form-group">
            <label for="user-phone" class="am-form-label">电话</label>
                <div class="am-form-content">
                    <input id="user-phone" readonly="readonly" placeholder="telephonenumber" type="tel" name="phone" value="{{$user->phone}}">

                </div>

        </div>
                            
            {{ csrf_field() }}
        <div class="info-btn">
                                     
            <button type="submit" id="sub" class="am-btn am-btn-danger">保存修改</button>
                                    

        </div>

    </form>

@endsection
