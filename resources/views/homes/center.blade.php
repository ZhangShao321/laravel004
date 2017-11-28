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
        <table aria-describedby="DataTables_Table_1_info" id="DataTables_Table_1" class="mws-datatable-fn mws-table dataTable">
            <thead>
                <tr role="row">
                    <th aria-label="Rendering engine: activate to sort column descending"
                    aria-sort="ascending" style="width: 156px;" colspan="1" rowspan="1" aria-controls="DataTables_Table_1"
                    tabindex="0" role="columnheader" class="sorting_asc">
                        电影院
                    </th>
                    <th aria-label="Browser: activate to sort column ascending" style="width: 212px;"
                    colspan="1" rowspan="1" aria-controls="DataTables_Table_1" tabindex="0"
                    role="columnheader" class="sorting">
                        电影
                    </th>
                    <th aria-label="Platform(s): activate to sort column ascending" style="width: 197px;"
                    colspan="1" rowspan="1" aria-controls="DataTables_Table_1" tabindex="0"
                    role="columnheader" class="sorting">
                        影厅
                    </th>
                  
                    <th aria-label="CSS grade: activate to sort column ascending" style="width: 97px;"
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
                    <th aria-label="CSS grade: activate to sort column ascending" style="width: 97px;"
                    colspan="1" rowspan="1" aria-controls="DataTables_Table_1" tabindex="0"
                    role="columnheader" class="sorting">
                        购票时间
                    </th>
                     
                    <th aria-label="CSS grade: activate to sort column ascending" style="width: 97px;"
                    colspan="1" rowspan="1" aria-controls="DataTables_Table_1" tabindex="0"
                    role="columnheader" class="sorting">
                        操作
                    </th>
                </tr>
            </thead>
            <tbody aria-relevant="all" aria-live="polite" role="alert">
             
                @foreach($res as $K=>$v)
                <tr class="odd" align="center">
                    <td class="sorting_1">
                    {{$v->cinema}}    
                    </td>
                

                
                    <td class="sorting_1 ">
                    {{$v->filmname}}    
                    </td>
                

                
                    <td class="sorting_1">
                    {{$v->roomname}}    
                    </td>

                   
               

                
                    <td class="sorting_1">
                    {{$v->showtime}}   
                    </td>
                

                
                    <td class="sorting_1">
                    {{$v->hang}}排{{ $v->lie }}座    
                    </td>

                    <td class="sorting_1">
                    {{$v->price}}   
                    </td>

                    <td class="sorting_1">
                    {{$v->time}}    
                    </td>
                
                    <td class="sorting_1">
                         
                       <form action="" method='post' style='display:inline'>
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button class='btn btn-primary'>删除</button>
                       </form>
                        
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>


@endsection

 
