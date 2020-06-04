@extends('AdminPublic.adminindex')
@section('title','修改分类')
@section('start')

<div class="container">
            
            	<!-- Statistics Button Container -->
            	
                
                <!-- Panels Start -->
                
            	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>修改分类</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<form class="mws-form" action="/adminusers/{{$info->id}}" method="post" enctype="multipart/form-data">
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">管理名:</label>
                    				<div class="mws-form-item">
                    					<input type="text" class="small" name="name" value="{{$info->name}}">
                    				</div>
                    			</div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">头像:</label>
                                    <div class="mws-form-item">
                                        <input type="file" class="small" name="uface" value="">
                                        <img style="width: 200px" src="{{$info->uface}}">
                                    </div>
                                </div>
                               
                    			{{csrf_field()}}
                                {{method_field('PUT')}}
                    			
                    		</div>
                    		<div class="mws-button-row">
                    			<input type="submit" value="Submit" class="btn btn-danger">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
                
            	
@endsection