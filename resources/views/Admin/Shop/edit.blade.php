@extends("AdminPublic.adminindex")
@section("start")
<html>
 <head></head>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span>商品修改</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <form class="mws-form" action="/adminshop/{{$data->id}}" method="post" enctype="multipart/form-data"> 
     <div class="mws-form-inline"> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">名字</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large" name="name" value="{{$data->name}}" /> 
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">类别</label> 
       <div class="mws-form-item"> 
        <select name="cate_id" class="large">
          
          @foreach($cates as $row)
          <option value="{{$row->id}}">{{$row->name}}</option>
          @endforeach
        </select> 
       </div> 
      </div> 


      <div class="mws-form-row"> 
       <label class="mws-form-label">旧图片</label> 
       <div class="mws-form-item"> 
       <img src="{{$data->pic}}" width="100px" height="100">
       </div> 
      </div> 
      <div class="mws-form-row"> 
       <label class="mws-form-label">图片</label> 
       <div class="mws-form-item"> 
        <input type="file" class="large"  name="pic" value="{{$data->pic}}"/> 
       </div> 
      </div> 
        <div class="mws-form-row"> 
       <label class="mws-form-label">描述</label> 
       <div class="mws-form-item"> 
        <textarea name="descr"></textarea>
       </div> 
      </div> 
        <div class="mws-form-row"> 
       <label class="mws-form-label">数量</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large"  name="num"  value="{{$data->num}}" /> 
       </div> 
      </div>
        <div class="mws-form-row"> 
       <label class="mws-form-label">单价</label> 
       <div class="mws-form-item"> 
        <input type="text" class="large"  name="price" value="{{$data->price}}" /> 
       </div> 
      </div>  
     </div> 
     <div class="mws-button-row"> 
      {{method_field('PUT')}}
      {{csrf_field()}}
      <input type="submit" value="Submit" class="btn btn-danger" /> 
      <input type="reset" value="Reset" class="btn " /> 
     </div> 
    </form> 
   </div> 
  </div>
 </body>
</html>
@endsection
@section("title","后台商品修改")