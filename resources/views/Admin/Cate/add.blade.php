@extends('AdminPublic.adminindex')
@section('title','分类添加')
@section('start')

<div class="container">
            
            	<!-- Statistics Button Container -->
            	
                
                <!-- Panels Start -->
                
            	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>添加分类</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<form class="mws-form" action="/admincates" method="post" enctype="multipart/form-data">
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">分类名:</label>
                    				<div class="mws-form-item">
                    					<input type="text" class="small" name="name" value="">
                    				</div>
                    			</div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">分类图片:</label>
                                    <div class="mws-form-item">
                                        <input type="file" class="small" name="img" value="">
                                    </div>
                                </div>
                               <div class="mws-form-row">
                                    <label class="mws-form-label">父类名:</label>
                                    <div class="mws-form-item">
                                       
                                        <select class="small" name="pid">
                                            <option value="0">--请选择--</option>
                                            <option value="0">顶级分类</option>
                                             @foreach($cates as $v)

                                                <option value="{{$v->id}}">
                                                   
                                                        {{$v->name}}
                                                   
                                                </option>
                                             @endforeach
                                        </select>
                                       
                                    </div>
                                </div>
                    			
                    			{{csrf_field()}}
                    			
                    		</div>
                    		<div class="mws-button-row">
                    			<input type="submit" value="Submit" class="btn btn-danger">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
                
            	
@endsection