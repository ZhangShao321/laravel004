@extends('admin.layout.admins')
        
@section('title','订单列表')


@section('content')

    <div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>
            <i class="icon-table">
            </i>
            订单列表
        </span>
    </div>
    <div class="mws-panel-body no-padding">
        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">

            <form action='/admin/ticket' method='get'>
            <div id="DataTables_Table_1_length" class="dataTables_length">
                <label>
                    显示
                     <select name="number" size="1" aria-controls="DataTables_Table_1">
                        <option value="5" @if(isset($_GET['number']) ? $_GET['number'] : '5') selected="selected"  @endif>
                            5
                        </option>
                        <option value="10" @if($request->number == '10')  selected="selected"  @endif>
                            10
                        </option>
                    
                
                    </select>
                    条数据
                </label>
                 <button class='btn btn-primary'>确定</button>
            </div>
            </form>

            <form action='/admin/ticket' method='get'>
            <div class="dataTables_filter" id="DataTables_Table_1_filter">
                <label>
                    关键字:
                    <input type="text" name='search' aria-controls="DataTables_Table_1">
                </label>
                <button class='btn btn-primary'>搜索</button>

            </div>
            </form>
            <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1"
            aria-describedby="DataTables_Table_1_info">
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                        style="width: 156px;">
                            ID
                        </th>
                        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                        style="width: 156px;">
                            用户名
                        </th>
                        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                        style="width: 156px;">
                            手机号
                        </th>
                 
                       <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                        style="width: 156px;">
                            电影院
                        </th>
                 
                       <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                        style="width: 156px;">
                            影厅
                        </th>
                 
                       <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                        style="width: 156px;">
                            影片
                        </th>
                 
                       <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                        style="width: 156px;">
                            座位
                        </th>
                 
                       <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                        style="width: 156px;">
                            放映时间
                        </th>
                 
                        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                        style="width: 156px;">
                            下单时间
                        </th>
                        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                        style="width: 156px;">
                            订单号
                        </th>
                        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                        style="width: 156px;">
                            操作
                        </th>
                    </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                    @foreach($res as $k=>$v)
                    <tr align="center" class="@if($k % 2== 1)odd @else even @endif">
                        <td>{{$v->id}}</td>
                        <td>{{$v->nick}}</td>
                        <td>{{$v->phone}}</td>          
                        <td>{{$v->cinema}}</td>              
                        <td>{{$v->roomname}}</td> 
                        <td>{{$v->filmname}}</td>             
                        <td>{{$v->hang}}排{{$v->lie }}座</td>                               
                        <td>{{date('Y-m-d H:i:s',$v->showtime)}}</td>              
                        <td>{{date('Y-m-d H:i:s',$v->time)}}</td>  
                        <td>{{$v->num}}</td>      
                        <td>
                       <!--  <form action="/admin/ticket/?{{$v->id}}&status={{$v->status}}" style="display:inline" method="post">  

                            {{csrf_field()}}
                            {{method_field('DELETE')}}                        

                             <button class="btn btn-danger del" name="">放入回收站</button>
                        </form>  --> 
                            @if($v->status == '0')
                            <button id="{{ $v->id }}" name="{{ $v->status }}" class="bb" class='btn btn-error'>放入回收站</button>
                            @else
                            <button id="{{ $v->id }}" name="{{ $v->status }}" class="bb" class='btn btn-error'>恢复</button>
                            @endif 
                        </td>
          

                    </tr>
                     @endforeach
                </tbody>
            </table>
            <div class="dataTables_info" id="DataTables_Table_1_info">
                
            </div>
             <style type="text/css">
                          

                            .pagination li{
                                background-color: #444444;
                                border-left: 1px solid rgba(255, 255, 255, 0.15);
                                border-right: 1px solid rgba(0, 0, 0, 0.5);
                                box-shadow: 0 1px 0 rgba(0, 0, 0, 0.5), 0 1px 0 rgba(255, 255, 255, 0.15) inset;
                                color: #fff;
                                cursor: pointer;
                                display: block;
                                float: left;
                                font-size: 12px;
                                height: 20px;
                                line-height: 20px;
                                outline: medium none;
                                padding: 0 10px;
                                text-align: center;
                                text-decoration: none;
                            }
                            .pagination .active{

                                background-color: #c5d52b;
                                border: medium none;
                                box-shadow: 0 0 4px rgba(0, 0, 0, 0.25) inset;
                                color: #323232;
                            }

                            .pagination a{
                                color: #fff;
                            }

                            .pagination{

                                margin:0px;
                            }
                            </style>
            <div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_1_paginate">
                 {!! $res->render() !!}
                   
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')
    <script>
    //修改ticket状态    回收站    
    $('.bb').click(function(){

        var ids = $(this).attr('id');
        var status = $(this).attr('name');
        var bbb = $(this);

        $.post("{{ url('/admin/ticket/huishou') }}", {_token:'{{ csrf_token() }}', id:ids, status:status}, function(data){
            
            // console.log(data);

          if(data == 2){
                bbb.text('放入回收站');
                bbb.attr('name',1);
                location.reload();
               
            }
        });
    })
    </script>

@endsection