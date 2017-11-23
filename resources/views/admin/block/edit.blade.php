@extends('admin.layout.admins')
        
@section('title','修改友情链接')


@section('content')

<div class="mws-panel grid_8">
          <div class="mws-panel-header">
               <span>修改友情链接</span>
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

               <form action="{{url('/admin/block/'.$res->id)}}" method="post" class="mws-form" enctype="multipart/form-data">
                    <div class="mws-form-inline">

                         <div class="mws-form-row">
                              <label class="mws-form-label">网站名称:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="linkname" class="small" value="{{$res->linkname}}">
                              </div>
                         </div>
                         
                         <div class="mws-form-row">
                              <label class="mws-form-label">链接:</label>
                              <div class="mws-form-item">
                                   <input type="text" name="url" class="small" value="{{$res->url}}">
                              </div>
                         </div>
               
                    </div>
                    <div class="mws-button-row">

                         {{csrf_field()}}
                         {{method_field('PUT')}}
                         <input type="submit" class="btn btn-primary" value="修改">
                    
                         
                    </div>
               </form>
          </div>         
      </div>


@endsection

