@extends('AdminPublic.adminindex')
@section('title','会员模型修改')
@section('start')

<div class="container">
            
            	<!-- Statistics Button Container -->
            	
                
                <!-- Panels Start -->
                
            	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>模型修改用户</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<form class="mws-form" action="/adminuser/{{$user->id}}" method="post">
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">用户名:</label>
                    				<div class="mws-form-item">
                    					<input type="text" class="small" name="name" value="{{$user->name}}">
                    				</div>
                    			</div>
                    			
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">邮箱:</label>
                    				<div class="mws-form-item">
                    					<input type="email" class="small" name="email"  value="{{$user->email}}">
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