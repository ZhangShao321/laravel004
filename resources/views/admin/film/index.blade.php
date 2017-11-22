@extends('admin.layout.admins')
        
@section('title','影视分类')

	
@section('content')
	
	<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>
            <i class="icon-table">
            </i>
            分类
        </span>
    </div>
    <div class="mws-panel-body no-padding">
        <div role="grid" class="dataTables_wrapper" id="DataTables_Table_0_wrapper">
            <div id="DataTables_Table_0_length" class="dataTables_length">
                <label>
                    显示
                    <select name="DataTables_Table_0_length" size="1" aria-controls="DataTables_Table_0">
                        <option value="10" selected="selected">
                            10
                        </option>
                        <option value="25">
                            25
                        </option>
                        <option value="50">
                            50
                        </option>
                        <option value="100">
                            100
                        </option>
                    </select>
                    条
                </label>
            </div>
            <div class="dataTables_filter" id="DataTables_Table_0_filter">
                <label>
                    搜索:
                    <input type="text" aria-controls="DataTables_Table_0">
                </label>
            </div>
            <table class="mws-datatable mws-table dataTable" id="DataTables_Table_0"
            aria-describedby="DataTables_Table_0_info">
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0"
                        rowspan="1" colspan="1" style="width: 156px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                            ID
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0"
                        rowspan="1" colspan="1" style="width: 212px;" aria-label="Browser: activate to sort column ascending">
                            类名
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0"
                        rowspan="1" colspan="1" style="width: 197px;" aria-label="Platform(s): activate to sort column ascending">
                            状态
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0"
                        rowspan="1" colspan="1" style="width: 133px;" aria-label="Engine version: activate to sort column ascending">
                            操作
                        </th>
                  
                    </tr>
                </thead>

                <tbody role="alert" aria-live="polite" aria-relevant="all">
                	 @foreach($res as $k=>$v)

                    <tr class="@if($k % 2 == 1) odd @else even @endif">
                        <td class="  sorting_1">
                            {{$v->id}}
                        </td>
                        <td class=" ">
                            {{$v->tname}}
                        </td>
                        <td class=" ">
                            {{$v->status}}
                        </td>
                        <td class=" ">
                            <button>修改</button>
                            <button>删除</button>
                        </td>
                        
                    </tr>

                    @endforeach
                </tbody>
            </table>
            <div class="dataTables_info" id="DataTables_Table_0_info">
                Showing 1 to 10 of 57 entries
            </div>
            <div class="dataTables_paginate paging_two_button" id="DataTables_Table_0_paginate">
                <a role="button" tabindex="0" class="paginate_disabled_previous" id="DataTables_Table_0_previous"
                aria-controls="DataTables_Table_0">
                    Previous
                </a>
                <a role="button" tabindex="0" class="paginate_enabled_next" id="DataTables_Table_0_next"
                aria-controls="DataTables_Table_0">
                    Next
                </a>
            </div>
        </div>
    </div>
</div>
@endsection