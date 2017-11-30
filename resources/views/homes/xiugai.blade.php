@extends('homes.layout.del')

@section('title','修改头像')

@section('content')
    <?php
        $uid = session('uid');
        $user = DB::table('user')->where('id',$uid)->first();
        $re = DB::table('userDetail')->where('uid',$uid)->first();
                            
    ?>
    <form class="am-form am-form-horizontal" action="{{url('/homes/doedit/'.$re->id)}}"  method="post" enctype="multipart/form-data">
                                     
        <div class="am-form-group">
            <label for="user-email" class="am-form-label">上传头像</label>
            <div class="am-form-content">
                <input id="user-email" placeholder="file" type="file" name="photo" value="">

            </div>
        </div>
                            
            {{ csrf_field() }}
        <div class="info-btn">
                                     
            <button type="submit" id="sub" class="am-btn am-btn-danger">保存修改</button>
                                    

        </div>

    </form>
@endsection