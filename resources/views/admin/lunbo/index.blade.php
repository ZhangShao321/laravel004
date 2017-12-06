@extends('admin.layout.admins')
        
@section('title','轮播图列表')

	
	
@section('content')
	

	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><i class="icon-th-list"></i>轮播图列表</span>
                    </div>  

			@if (session('msg'))
				    <div class="mws-form-message success">
				        <ul>
				            {{session('msg')}}
				        </ul>
				    </div>
			@endif


             <div class="mws-panel-body no-padding">
                        <table class="mws-table">
                            <thead>
                                <tr>
                                    <th style="width:97px;">ID</th>
                                    <th style="width:97px;">轮播图</th>
                                    <th style="width:97px;">电影名称</th>
                                    <th style="width:97px;">上传时间</th>
                                    <th style="width:97px;">状态</th>
                                    <th style="width:120px;">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($res as $k=>$v)
                                <tr align="center">
                                    <td>{{$v->id}}</td>
                                    <td><img src="http://ozspa9a4f.bkt.clouddn.com/Uplodes/{{($v->picname)}}" style="width:200px;height:80px;"></td>
                                    <td>{{$v->fname}}</td>
                                    <td>{{date('Y-m-d  H:i:s',$v->time)}}</td>
                                    <td>
                                        
                                         @if($v->status == '0')
                                        <button id="{{ $v->id }}" name="{{ $v->status }}" class="bb" class='btn btn-error'>开启</button>
                                        @else
                                        <button id="{{ $v->id }}" name="{{ $v->status }}" class="bb" class='btn btn-error'>关闭</button>
                                        @endif         

                                    </td>
                                    <td>
                                    	<a href="/admin/lunbo/{{$v->id}}/edit"><button class="btn btn-primary">编辑</button></a>
                                    	
                                    	<form action="/admin/lunbo/{{$v->id}}" style="display:inline" method="post">

                                    	{{csrf_field() }}	
                                    	{{method_field('DELETE') }}	
                                    	<a href="/admin/lunbo/{{$v->id}}"><button class="btn btn-danger">删除</button></a>
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

        $('.mws-form-message').delay(2000).slideUp(1000);


        //修改状态    
        $('.bb').click(function(){

            var ids = $(this).attr('id');
            var status = $(this).attr('name');
            var bbb = $(this);

            $.post("{{ url('/admin/lunbo/lbzt') }}", {_token:'{{ csrf_token() }}', id:ids, status:status}, function(data){
                
                // console.log(data);

                if(data == 1){
                    bbb.text('开启');
                    bbb.attr('name',0);
                } else if(data == 2){
                    bbb.text('关闭');
                    bbb.attr('name',1);
                }
            });
        })
</script>




@endsection