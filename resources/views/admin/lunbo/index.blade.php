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
                                    <th style="width:97px;">电影院名称</th>
                                    <th style="width:97px;">上传时间</th>
                                    <th style="width:97px;">状态</th>
                                    <th style="width:120px;">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($res as $k=>$v)
                                <tr>
                                    <td>{{$v->id}}</td>
                                    <td><img src="{{asset($v->picname)}}" style="width:180px;height:100px;"></td>
                                    <td>{{$v->fname}}</td>
                                    <td>{{date('Y-m-d  H:i:s',$v->time)}}</td>
                                    <td>{{$v->status == 0 ?'正在使用':'未使用'}}</p></td>
                                    <td>
                                    	<a href="/admin/lunbo/{{$v->id}}/edit"><button class="btn btn-primary">修改</button></a>
                                    	
                                    	<form action="/admin/lunbo/{{$v->id}}" method="post">

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

    </script>

@endsection