@extends('admin.layout.admins')
        
@section('title','商户列表')

@section('content')

<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>
            <i class="icon-table">
            </i>
            商户列表
        </span>
    </div>
    <div class="mws-panel-body no-padding">
        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
            <form action='/admin/cinema' method='get'>
                <div class="dataTables_length" id="DataTables_Table_1_length">
                    <label>
                        显示
                        <select name="num" size="1" aria-controls="DataTables_Table_1">
                           <option value="5" @if(isset($_GET['num']) ? $_GET['num'] : '5') selected="selected"  @endif>
                               5
                           </option>
                                
                            <option value="10" @if($request->num == '10') selected="selected"  @endif>
                                10
                            </option>

                           
                        </select>
                        条数据
                    </label>
                    <button class='btn btn-primary'>确定</button>
                </div>
            </form>
            <form action='/admin/cinema' method='get'>

                <div class="dataTables_filter" id="DataTables_Table_1_filter">
                    <label>
                        关键字:
                        <input type="text" name='search' aria-controls="DataTables_Table_1" value="{{isset($_GET['search']) ? $_GET['search'] : '' }}">
                    </label>

                    <button class='btn btn-primary'>搜索</button>
                </div>
            </form>
            

        <table aria-describedby="DataTables_Table_1_info" id="DataTables_Table_1" class="mws-datatable-fn mws-table dataTable">
            <thead>
                <tr role="row">
                    <th aria-label="Rendering engine: activate to sort column descending"
                    aria-sort="ascending" style="width: 156px;" colspan="1" rowspan="1" aria-controls="DataTables_Table_1"
                    tabindex="0" role="columnheader" class="sorting_asc">
                        ID
                    </th>
                    <th aria-label="Browser: activate to sort column ascending" style="width: 212px;"
                    colspan="1" rowspan="1" aria-controls="DataTables_Table_1" tabindex="0"
                    role="columnheader" class="sorting">
                        电影院名称
                    </th>
                    <th aria-label="Platform(s): activate to sort column ascending" style="width: 197px;"
                    colspan="1" rowspan="1" aria-controls="DataTables_Table_1" tabindex="0"
                    role="columnheader" class="sorting">
                        手机号
                    </th>
                    <th aria-label="CSS grade: activate to sort column ascending" style="width: 97px;"
                    colspan="1" rowspan="1" aria-controls="DataTables_Table_1" tabindex="0"
                    role="columnheader" class="sorting">
                        省
                    </th>
                    <th aria-label="CSS grade: activate to sort column ascending" style="width: 97px;"
                    colspan="1" rowspan="1" aria-controls="DataTables_Table_1" tabindex="0"
                    role="columnheader" class="sorting">
                        市
                    </th>
                    <th aria-label="CSS grade: activate to sort column ascending" style="width: 97px;"
                    colspan="1" rowspan="1" aria-controls="DataTables_Table_1" tabindex="0"
                    role="columnheader" class="sorting">
                        县
                    </th>
                    <th aria-label="CSS grade: activate to sort column ascending" style="width: 97px;"
                    colspan="1" rowspan="1" aria-controls="DataTables_Table_1" tabindex="0"
                    role="columnheader" class="sorting">
                        电影院logo
                    </th>
                    <th aria-label="CSS grade: activate to sort column ascending" style="width: 97px;"
                    colspan="1" rowspan="1" aria-controls="DataTables_Table_1" tabindex="0"
                    role="columnheader" class="sorting">
                        时间
                    </th>
                    <th aria-label="CSS grade: activate to sort column ascending" style="width: 97px;"
                    colspan="1" rowspan="1" aria-controls="DataTables_Table_1" tabindex="0"
                    role="columnheader" class="sorting">
                        法人
                    </th>
                    <th aria-label="CSS grade: activate to sort column ascending" style="width: 97px;"
                    colspan="1" rowspan="1" aria-controls="DataTables_Table_1" tabindex="0"
                    role="columnheader" class="sorting">
                        操作
                    </th>
                </tr>
            </thead>
            <tbody aria-relevant="all" aria-live="polite" role="alert">
            @foreach($res as $k => $v)
                <tr class="odd" align="center">
                    <td class="sorting_1">
                        {{$v->id}}
                    </td>

                    <td class=" ">
                        {{$v->cinema}}
                    </td>

                    <td class=" ">
                        {{$v->phone}}
                    </td>

                    <td class=" ">
                        {{$v->city}}
                    </td>

                    <td class=" ">
                        {{$v->area}}
                    </td>

                    <td class=" ">
                        {{$v->address}}
                    </td>

                    <td class="">
                        <img src="{{asset($v->clogo)}}" alt="" style="height: 50px" >
                    </td>

                    <td class=" ">
                        {{date('Y-m-d H:i:s',$v->time)}}
                    </td>

                    <td class=" ">
                        {{$v->legal}}
                    </td>

                    <td class=" ">
                        <a href="{{url('/admin/cinema/'.$v->id.'/edit')}}" class='btn btn-primary'>修改</a>

                       <form action="/admin/cinema/{{$v->id}}" method='post' style='display:inline'>
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button class='btn btn-primary'>删除</button>
                       </form>
                        
                    </td>
                </tr>

            @endforeach 
            </tbody>
        </table>


            <style>
            .pagination li{
                background-color: #444444;
                border-left: 1px solid rgba(255, 255, 255, 0.15);
                border-right: 1px solid rgba(0, 0, 0, 0.5);
                box-shadow: 0 1px 0 rgba(0, 0, 0, 0.5), 0 1px 0 rgba(255, 255, 255, 0.15) inset;
                
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

            .pagination a{
                color: #fff;

            }
            
            .pagination .active{
                background-color: #88a9eb;
                background-image: none;
                border: medium none;
                box-shadow: 0 0 4px rgba(0, 0, 0, 0.25) inset;
                color: #323232;
            }

            .pagination .disabled{
                color: #666666;
                cursor: default;
            }

            .pagination{

                margin:0px;
            }



            </style>

            <div class="dataTables_paginate paging_full_numbers">

                {!! $res->appends($request->all())->render() !!} 
              
            </div>
        </div>
    </div>
</div>




@endsection