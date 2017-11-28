@extends('FilmAdmins.layout.index')

@section('title', '放映添加')


@section('content')
     
		<div class="mws-panel grid_8">
			    <div class="mws-panel-header">
			        <span>
			            放映添加
			        </span>
			    </div>
			    <div class="mws-panel-body no-padding">
                
                 @if (count($errors) > 0)
                    <div class="mws-form-message error">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                 @endif




			        <form action="{{asset('/FilmAdmins/showdoAdd')}}" method="post" class="mws-form">
			            <div class="mws-form-inline">
			              <div class="mws-form-row">
                				<label class="mws-form-label">电影名称</label>
                				<div class="mws-form-item">
                					<select class="large" name="fid">
                                @foreach($film as $k => $v)
                						<option value="{{$v->id}}">{{$v->filmname}}</option>
                                @endforeach 
                					</select>
                				</div>
                    		</div>

                    		<div class="mws-form-row">
                				<label class="mws-form-label">影厅名称</label>
                				<div class="mws-form-item">
                					<select id="sel" class="large" name="rid">
                						<option value="">请选择影厅</option>
                                        @foreach($room as $rk => $rv)
                                        <option value="{{$rv->id}}">{{$rv->roomname}}</option>
                                        @endforeach 
                					</select>
                				</div>
                    		</div>

                            <div class="mws-form-row">
                                <label class="mws-form-label">价格</label>
                                <div class="mws-form-item">
                                    <input type="number" name="price"> /元
                                </div>
                            </div>

                            <div class="mws-form-row">
                                <label class="mws-form-label">空闲时间</label>
                                <div class="mws-form-item">
                                    <input type="text" name="ktime">
                                </div>
                            </div>

                    		 <div class="mws-form-row">
			                    <label class="mws-form-label">
			                       开始时间
			                    </label>
			                    <div class="mws-form-item">
			                        <!-- <input type="text" name="time" class="medium"> -->
                                 <input type="text" name="time" class="large" id="AbsentEndDate" runat="server"  readonly="readonly" />  
			                    </div>
			                </div>

                            {{ csrf_field() }}



			               
			           
			            </div>
			            <div class="mws-button-row">
			                <input type="submit" id="time" class="btn btn-danger" value="添加">
			            </div>
			        </form>
			    </div>
			</div>



@endsection


@section('js')
<script>
$('#sel').blur(function(){
    var id = $(this).val();

    $.post('{{ url("/FilmAdmins/showtime") }}',{_token:'{{ csrf_token() }}', id:id}, function(data){

        console.log(data);
        $('input[name=ktime]').val(data);
    })

}) 

$('input[name=time]').change(function(){

    var time = $(this).val();

    var ktime = $('input[name=ktime]').val();

    if(time < ktime){

        layer.alert('放映时间不合适', {icon: 6});
        $(this).val('');
    }


})

</script>


@endsection


