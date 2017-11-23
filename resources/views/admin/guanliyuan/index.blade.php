@extends('admin.layout.admins')
        
@section('title','管理员列表')


@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <tr>                              
                        <td>{{$v->id}}</td>
                        <td>{{$v->phone}}</td>                        
                        <td>{{date('Y-m-d H:i:s',$v->lastlogin)}}</td>
                        <td>
                             <button class='btn btn-error'>{{$v->auth ? '开启': '关闭'}}</button>
                        </td>
                        <td>
                            <button class='btn btn-info'>{{$v->status ? '开启': '关闭'}}</button>
                        </td>
                        <td>
                            
                            <form action="" method="post">     
                                {{csrf_field()}}
                                {{method_field('DELETE')}}

                            <button class="btn btn-danger del" name="{{$v->id}}" >删除</button>

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

<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        
   //执行删除触发事件
    $(".del").click(function(){
        //获取id
         var id = $(this).attr('name');
         // console.log(id);
                
         layer.alert('你确定要删除此信息', {
            skin: 'layui-layer-molv' //样式类名  自定义样式
            ,closeBtn: 1    // 是否显示关闭按钮
            ,anim: 1 //动画类型
            ,btn: ['确定','取消'] //按钮
            ,icon: 5    // icon  6 笑脸  4,锁  5 哭 3,?  2,X  1,√ 0,!
            ,shadeClose: false
            ,yes:function(){
                // layer.msg('执行中');
                layer.msg('执行中', {
                              icon: 16
                              ,shade: 0.001
                            });

                // console.log(id);
                $.ajax({
                            type: "POST",
                            url: "/admin/guanliyuan/"+id,
                            data: '_method='+'delete',
                            // data: { '_method':'delete','_token':"{{csrf_token()}}"},
                            success: function(msg){
                              alert(msg);
                              // console.log(msg);
                               location.reload();  
                            }
                        });

            }
            ,btn2:function(){
                // layer.msg('按钮2');取消执行的按钮
            }});

         return false;
    });





   
</script>

@endsection
