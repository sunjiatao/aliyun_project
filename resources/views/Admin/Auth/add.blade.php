@extends('AdminPublic.adminindex')
@section('title','权限添加')
@section('start')

<div class="container">
            
            	<!-- Statistics Button Container -->
            	
                
                <!-- Panels Start -->
                
            	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>添加权限</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<form class="mws-form" action="/auth" method="post" enctype="multipart/form-data">
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">权限名:</label>
                    				<div class="mws-form-item">
                    					<input type="text" class="small" name="name" value="">
                    				</div>
                    			</div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">控制器名:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="small" name="mname" value="">
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">方法名:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="small" name="aname" value="">
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