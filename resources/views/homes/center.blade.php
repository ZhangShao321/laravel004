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
        <table align="center" aria-describedby="DataTables_Table_1_info" id="DataTables_Table_1" >
            <thead>
                <tr align="center">
                    <th style="width: 130px;" align="center">
                        电影院
                    </th>
                    <th aria-label="Browser: activate to sort column ascending" style="width: 80px;"
                    colspan="1" rowspan="1" aria-controls="DataTables_Table_1" tabindex="0"
                    role="columnheader" class="sorting">
                        电影
                    </th>
                    <th aria-label="Platform(s): activate to sort column ascending" style="width: 80px;"
                    colspan="1" rowspan="1" aria-controls="DataTables_Table_1" tabindex="0"
                    role="columnheader" class="sorting">
                        影厅
                    </th>
                  
                    <th aria-label="CSS grade: activate to sort column ascending" style="width: 197px;"
                    colspan="1" rowspan="1" aria-controls="DataTables_Table_1" tabindex="0"
                    role="columnheader" class="sorting">
                        放映时间
                    </th>
                    <th aria-label="CSS grade: activate to sort column ascending" style="width: 97px;"
                    colspan="1" rowspan="1" aria-controls="DataTables_Table_1" tabindex="0"
                    role="columnheader" class="sorting">
                        排_座
                    </th>
                    <th aria-label="CSS grade: activate to sort column ascending" style="width: 97px;"
                    colspan="1" rowspan="1" aria-controls="DataTables_Table_1" tabindex="0"
                    role="columnheader" class="sorting">
                        价格
                    </th>
                    <th aria-label="CSS grade: activate to sort column ascending" style="width: 197px;"
                    colspan="1" rowspan="1" aria-controls="DataTables_Table_1" tabindex="0"
                    role="columnheader" class="sorting">
                        购票时间
                    </th>
                    <th aria-label="CSS grade: activate to sort column ascending" style="width: 197px;"
                    colspan="1" rowspan="1" aria-controls="DataTables_Table_1" tabindex="0"
                    role="columnheader" class="sorting">
                        订单号
                    </th>
                     
                    <th aria-label="CSS grade: activate to sort column ascending" style="width: 97px;"
                    colspan="1" rowspan="1" aria-controls="DataTables_Table_1" tabindex="0"
                    role="columnheader" class="sorting">
                        操作
                    </th>
                </tr>
            </thead>
            @if (session('msg'))
                <div class="mws-form-message success">
                    <ul>
                        {{session('msg')}}
                    </ul>
                </div>
            @endif    

            <tbody align="center">
             
                @foreach($res as $K=>$v)
                @if($v->status==0)
                <tr class="" align="center">
                    <td class="" align="center">
                    {{$v->cinema}}    
                    </td>
                
                    <td class="sorting_1 ">
                    {{$v->filmname}}    
                    </td>
                
                    <td class="sorting_1">
                    {{$v->roomname}}    
                    </td>

                   
                    <td class="sorting_1">
                    {{date('Y-m-d H:i:s',$v->showtime)}}   
                    </td>
                
                    <td class="sorting_1">
                    {{$v->hang}}排{{ $v->lie }}列    
                    </td>

                    <td class="sorting_1">
                    {{$v->price}}￥
                    </td>

                    <td class="sorting_1">

                    {{date('Y-m-d H:i:s',$v->time)}}    
                    </td>
                    
                    <td class="sorting_1">
                    {{$v->num}}    
                    </td>
                    <td class="sorting_1">
                         
                        
                        {{csrf_field()}}
                             
                        <a href="{{url('/homes/delete/'.$v->id)}}"><button class='btn btn-primary'>删除</button></a>
                     
                        
                    </td>

                </tr>
                @endif
                @endforeach
            </tbody>
        </table>


@endsection

 
 
