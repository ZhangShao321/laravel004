@extends('admin.layout.admins')
        
@section('title','影视分类')

	
@section('content')
<div class="mws-panel grid_8">

        <div class="mws-panel-header">

            <span><i class="icon-table"></i>影视分类列表</span>

        </div>
        <div class="mws-panel-body no-padding">

                    @if (session('msg'))
                    <div class="mws-form-message info">
                        <ul>
                            {{session('msg')}}
                        </ul>
                    </div>
            @endif

            <table class="mws-table">
                <thead>
                    <tr>

                        <th>ID</th>      
                        <th>类名</th>                 
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($res as $k=>$v)
                    <tr align="center" class="warning"style="background: @if($k % 2 ==0) lightblue @endif;">                              
                        <td>{{$v->id}}</td>
                        <td>{{$v->tname}}</td>                        
                        <td>
                            {{$v->status==0 ? '开启': '关闭'}}
                        </td>
                        <td>
                            <a href="/admin/film/{{$v->id}}/edit"><button class="btn btn-primary">修改</button></a>

                            <form action="/admin/film/{{$v->id}}" method="post">     
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

        $('.mws-form-message').delay(2000).slideUp(1000);

    </script>


@endsection