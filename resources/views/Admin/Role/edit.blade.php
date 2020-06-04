@extends('AdminPublic.adminindex')
@section('title','修改角色')
@section('start')

<div class="container">
            
            	<!-- Statistics Button Container -->
            	
                
                <!-- Panels Start -->
                
            	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>修改角色</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<form class="mws-form" action="/role/{{$info->id}}" method="post" enctype="multipart/form-data">
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">角色名:</label>
                    				<div class="mws-form-item">
                    					<input type="text" class="small" name="name" value="{{$info->name}}">
                    				</div>
                    			</div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">状态:</label>
                                    <div class="mws-form-item" style="float: left">
                                        <input type="radio" class="small" name="status" value="0" @if($info->status=='0') checked @endif>开启
                                       
                                    </div>
                                    <div class="mws-form-item" style="float: left">
                                        <input type="radio" class="small" name="status" value="1" @if($info->status=='1') checked @endif>禁用
                                       
                                    </div>
                                    <div style="clear: both;"></div>
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