@extends('FilmAdmins.layout.index')

@section('title', '放映编辑')


@section('content')
     
		<div class="mws-panel grid_8">
			    <div class="mws-panel-header">
			        <span>
			            放映编辑
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



			        <form action="{{asset('/FilmAdmins/showUpdate?id=').$res['id']}}" method="post" class="mws-form">
                        <div class="mws-form-inline">
                        
                          <div class="mws-form-row">
                                <label class="mws-form-label">电影名称</label>
                                <div class="mws-form-item">
                                    <select class="large" name="fid">
                                
                                       
                                        @foreach($film as $fk => $fv)
                                        
                                        <option  value="{{$fv->id}}" @if( $res['filmname'] == $fv->filmname) selected  @endif > {{$fv->filmname}} </option>
                                          @endforeach 

                               
                                    </select>
                                </div>
                            </div>


                            

                            <div class="mws-form-row">
                                <label class="mws-form-label">影厅名称</label>
                                <div class="mws-form-item">
                                    <select class="large" name="rid">
                                      
                                        
                                         @foreach($room as $rk => $rv)
                                        <option  value="{{$rv->id}}" @if( $res['roomname'] == $rv->roomname) selected  @endif > {{$rv->roomname}} </option>
                                          @endforeach 

                                       
                                    
                                    </select>
                                </div>
                            </div>

                            <div class="mws-form-row">
                                <label class="mws-form-label">价格</label>
                                <div class="mws-form-item">
                                  <input type="number" name="price" value="{{ $res['price'] }}">
                                </div>
                            </div>
                            

                               <div class="mws-form-row">
                                <label class="mws-form-label">放映状态</label>
                                <div class="mws-form-item">
                                    <select class="large" name="status">
                                      
                                        <!-- 0,即将放映  1,正在, 2,放映结束/ 默认0 -->

                                         @foreach($arr as $ak => $av)
                                        

                                          <option  value="{{$ak}}" @if($res['status'] == $ak) selected  @endif > {{$av}} </option>

                              
                                          @endforeach 

                                
e

                                       
                                    
                                    </select>
                                </div>
                            </div>





                             <div class="mws-form-row">
                                <label class="mws-form-label">
                                   开始时间
                                </label>
                                <div class="mws-form-item">
                                    
                              <input type="text" name="time" value="{{date('Y-m-d H:i:s',$res['time'])}}" class="medium" id="AbsentEndDate" runat="server"  readonly="readonly" />  


                                </div>
                            </div>

                            {{ csrf_field() }}
                
                           
                           
                       
                        </div>
                        <div class="mws-button-row">
                            <input type="submit" id="time" class="btn btn-danger" value="修改">
                        </div>
        

                    </form>



			    </div>
			</div>





@endsection




@section('js')




@endsection


