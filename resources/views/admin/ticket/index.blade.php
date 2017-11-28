@extends('admin.layout.admins')
        
@section('title','管理员列表')


@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
	<div class="mws-panel grid_8">

    	<div class="mws-panel-header">

        	<span><i class="icon-table"></i>订单信息列表</span>

        </div>
        <div class="mws-panel-body no-padding">
            <table class="mws-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>用户名</th>
                        <th>电影院</th>                                
                        <th>影厅</th>
                        <th>影片</th>
                        <th>座位</th>
                        <th>放映时间</th>
                        <th>下单时间</th>
                        <th>订单号</th>
                        <th>操作</th>

                    </tr>
                </thead>
                <tbody>
                @foreach($res as $k=>$v)
                    <tr align="center">                              
                        <td>{{$v->id}}</td>
                        <td>{{$v->phone}}</td>                        
                        <td>{{$v->cinema}}</td>              
                        <td>{{$v->roomname}}</td> 
                        <td>{{$v->filmname}}</td>             
                        <td>{{$v->hang}}排{{ $v->lie }}座</td>                          
                        <td>{{date('Y-m-d H:i:s',$v->showtime)}}</td>              
                        <td>{{date('Y-m-d H:i:s',$v->time)}}</td>  
                        <td>{{$v->num}}</td>                          

                        <td>
                            <form action="/admin/ticket/{{$v->id}}" style="display:inline" method="post">  
                                

                                {{csrf_field()}}
                                {{method_field('DELETE')}}

                            <button class="btn btn-danger del" name="" >删除</button>

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


@endsection

