@extends('admin.layout.admins')
        
@section('title','添加友情链接')
               
@section('content')
     <div class="mws-panel grid_8">
          <div class="mws-panel-header">
               <span>添加友情链接</span>
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

               <form action="{{url('admin/block/')}}" method="post" class="mws-form" enctype="multipart/form-data">
                    <div class="mws-form-inline">

                         <div class="mws-form-row">
                              <label class="mws-form-label">网站名称:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="linkname" class="small" value="">
                              </div>
                         </div>
                         <div class="mws-form-row">
                              <label class="mws-form-label">链接:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="url" class="small" value="http://">
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

