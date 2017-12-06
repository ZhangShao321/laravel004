@extends('FilmAdmins.layout.index')
        
@section('title','个人订单列表')


@section('content')

    <div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>
            <i class="icon-table">
            </i>
            个人订单列表
        </span>
    </div>
    <div class="mws-panel-body no-padding">
        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">

            <form action='/admin/ticket' method='get'>
            <div id="DataTables_Table_1_length" class="dataTables_length">

            </div>
            </form>

            <form action='/admin/ticket' method='get'>
            <div class="dataTables_filter" id="DataTables_Table_1_filter">


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
                            手机号
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
                            价格 
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
                        <td>{{$v->phone}}</td>             
                        <td>{{$v->roomname}}</td> 
                        <td>{{$v->filmname}}</td>             
                        <td>{{$v->hang}}排{{$v->lie }}座</td> 
                        <td>￥{{$v->price}}/元</td>                              
                        <td>{{date('m月d日 H时i分',$v->showtime)}}</td>              
                        <td>{{date('Y-m-d H:i:s',$v->time)}}</td>  
                        <td>{{$v->num}}</td>
                        <td>
                            <button class="btn btn-default">打印</button>
                            <button  id="{{ $v->id }}" class="btn btn-default dels">取消</button>
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
    
    $('.dels').click(function(){

        var id = $(this).attr('id');

        $.post('{{ url("FilmAdmins/seach/del") }}',{_token:'{{ csrf_token() }}',id:id},function(data){

            // console.log(data);
            if(data == 1){

                // layer.alert('取消成功', {icon: 6});

                window.location.reload();
            }else{
                // layer.alert('取消失败', {icon: 6});
                window.location.reload();
            }
        })
    })
</script>

@endsection