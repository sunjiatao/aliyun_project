@extends('AdminPublic.adminindex')
@section('title','分配角色')
@section('start')
<div class="container">
                                                            
<div class="container">
    <div class="mws-panel-body no-padding"> 
     <form class="mws-form" action="/saverole/{{$info->id}}" method="post"> 
      <div class="mws-form-inline"> 
       <div class="mws-form-row"> 
        <label class="mws-form-label">角色信息</label> 
        <div class="mws-form-item clearfix"> 
         <h4>当前用户:{{$info->name}}的角色信息</h4> 
         <ul class="mws-form-list inline">
           
            <li>
            	@foreach($role as $v)
            	<input type="radio" name="rids" value="{{$v->id}}" @if (in_array($v->id,$rids)) checked @endif > 
            	<label>{{$v->name}}</label>
            	@endforeach
            </li>  
                      
          </ul> 
        </div> 
       </div> 
      </div> 
      <div class="mws-button-row">
        {{csrf_field()}}
        
        
        <input type="hidden" name="uid" value="{{$info->id}}">
        <!-- <input type="hidden" name="id" value="{{$info->id}}"> -->
       <input value="分配角色" class="btn btn-danger" type="submit"> 
       <input value="Reset" class="btn " type="reset"> 
      </div> 
     </form> 
    </div> 
    <!-- Panels End --> 
   </div>
                    

                               
                    <!-- Panels End -->
</div>

@endsection