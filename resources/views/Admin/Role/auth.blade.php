@extends('AdminPublic.adminindex')
@section('title','分配权限')
@section('start')
<div class="container">
                                                            
<div class="container">
    <div class="mws-panel-body no-padding"> 
     <form class="mws-form" action="/saveauth" method="post"> 
      <div class="mws-form-inline"> 
       <div class="mws-form-row"> 
        <label class="mws-form-label">权限信息</label> 
        <div class="mws-form-item clearfix"> 
         <h4>当前角色:{{$info->name}}的权限信息</h4> 
         <ul class="mws-form-list inline">
           
            <li>
            	@foreach($auth as $v)
            	<input type="checkbox" name="nids[]" value="{{$v->id}}" @if(in_array($v->id,$nids)) checked  @endif > 
            	<label>{{$v->name}}</label>
            	@endforeach
            </li>  
                      
          </ul> 
        </div> 
       </div> 
      </div> 
      <div class="mws-button-row">
        {{csrf_field()}}
        
        
        <input type="hidden" name="rid" value="{{$info->id}}">
        
       <input value="分配权限" class="btn btn-danger" type="submit"> 
       <input value="Reset" class="btn " type="reset"> 
      </div> 
     </form> 
    </div> 
    <!-- Panels End --> 
   </div>
                    

                               
                    <!-- Panels End -->
</div>

@endsection