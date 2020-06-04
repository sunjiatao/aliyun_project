@extends('AdminPublic.adminindex')
@section('title','管理添加')
@section('start')

<div class="container">
            
            	<!-- Statistics Button Container -->
            	
                
                <!-- Panels Start -->
                
            	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>添加分类</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<form class="mws-form" action="/adminusers" method="post" enctype="multipart/form-data">
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">管理名:</label>
                    				<div class="mws-form-item">
                    					<input type="text" class="small" name="name" value="{{old('name')}}">
                    				</div>
                    			</div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">密码:</label>
                                    <div class="mws-form-item">
                                        <input type="password" class="small" name="password" value="">
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">确认密码:</label>
                                    <div class="mws-form-item">
                                        <input type="password" class="small" name="repassword" value="">
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">头像:</label>
                                    <div class="mws-form-item">
                                        <input type="file" class="small" name="uface" value="">
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