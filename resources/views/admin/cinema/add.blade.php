@extends('admin.layout.admins')
        
@section('title','商户添加')
               
@section('content')
     <div class="mws-panel grid_8">
          <div class="mws-panel-header">
               <span>添加商户</span>
          </div>
          <div class="mws-panel-body no-padding">

               @if (count($errors) > 0)
                  <div class="mws-form-message error">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li style='list-style:none;'>{{ $error }}</li>
                          @endforeach
                      </ul>
                    </div>
               @endif

               <!-- id
               电影院名称
               电影院地址id
               电影院法人
               电影院联系电话
               营业执照照片
               影院logo
               状态 -->


               <form action="{{url('admin/cinema/')}}" method="post" class="mws-form" enctype="multipart/form-data">
                    <div class="mws-form-inline">

                         <div class="mws-form-row">
                              <label class="mws-form-label">电影院名称:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="cinema" class="small" value="">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">密码:</label>
                              <div class="mws-form-item">
                                   <input type="password" name="password" class="small">
                              </div>
                         </div>
                         
                         <div class="mws-form-row">
                              <label class="mws-form-label">电影院联系电话:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="phone" class="small" value="">
                              </div>
                         </div>


                         <div class="mws-form-row">
                              <label class="mws-form-label">省份:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="city" class="small" value="">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">市区:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="area" class="small" value="">
                              </div>
                         </div>

                         <div class="mws-form-row">
                              <label class="mws-form-label">详细地址：</label>
                              <div class="mws-form-item clearfix">
                                   <input type="text" name="address" class="small" value="">
                              </div>
                         </div>

                         <div class="mws-form-row">
                              <label class="mws-form-label">法人：</label>
                              <div class="mws-form-item clearfix">
                                <input type="text" name="legal" class="small" value="">
                              </div>
                         </div>
                         
                         <div class="mws-form-row">
                              <label class="mws-form-label">状态：</label>
                            <div class="mws-form-item clearfix">
                              <input type="text" name="status" class="small" value="2">
                            </div>
                         </div>
                         <div class="mws-form-row">
                             <label class="mws-form-label">
                                   电影院logo:
                             </label>
                             <div class="mws-form-item">
                                 <input type="file" readonly="readonly" style="width: 100%; padding-right: 85px;"
                                 class="fileinput-preview" placeholder="文件上传" name='clogo'>
                             </div>
                         </div>
               
                    </div>
                    <div class="mws-button-row">

                         {{ csrf_field() }}
                         <input type="submit" class="btn btn-primary" value="添加">
                    
                         
                    </div>
               </form>
          </div>         
      </div>


@endsection
