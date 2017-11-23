@extends('admin.layout.admins')
        
@section('title','管理员列表')


@section('content')
	<div class="mws-panel grid_8">

    	<div class="mws-panel-header">

        	<span><i class="icon-table"></i>管理员列表</span>

        </div>
        <div class="mws-panel-body no-padding">
            <table class="mws-table">
                <thead>
                    <tr>

                        <th>ID</th>      
                        <th>用户名</th>                 
                        <th>最后登录时间</th>
                        <th>权限</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($res as $k=>$v)
                    <tr align="center">                              
                        <td>{{$v->id}}</td>
                        <td>{{$v->phone}}</td>                        
                        <td>{{date('Y-m-d H:i:s',$v->lastlogin)}}</td>
                        <td>
                            @if($v->auth == '0')
                            <button id="{{ $v->id }}" name="{{ $v->auth }}" class="bb" class='btn btn-error'>关闭</button>
                            @else
                            <button id="{{ $v->id }}" name="{{ $v->auth }}" class="bb" class='btn btn-error'>开启</button>
                            @endif
                        </td>
                        <td>
                            @if($v->status == '1')
                            一般管理员
                            @elseif($v->status == '2')
                            中级管理员
                            @elseif($v->status == '3')
                            超级管理员
                            @endif

                        </td>
                        <td>
                            <a href="/admin/guanliyuan/{{$v->id}}/edit"><button class="btn btn-danger">修改</button></a>&nbsp;&nbsp;&nbsp;
                            <form action="/admin/guanliyuan/{{$v->id}}" style="display:inline" method="post">  
                                
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                            <button class="btn btn-danger">删除</button>
                            
                            </form>
                        </td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>

    </div>


@endsection

@section('js')
<script>
    
$('.bb').click(function(){

    var ids = $(this).attr('id');
    var auth = $(this).attr('name');
    var bbb = $(this);

    $.post("{{ url('/admin/guanliyuan/work') }}", {_token:'{{ csrf_token() }}', id:ids, auth:auth}, function(data){
        
        // console.log(data);

        if(data == 1){
            bbb.text('关闭');
            bbb.attr('name',0);
        } else if(data == 2){
            bbb.text('开启');
            bbb.attr('name',1);
        }
    });
})
</script>
@endsection