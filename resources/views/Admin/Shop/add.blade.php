@extends('AdminPublic.adminindex')
@section('title','商品添加')
@section('start')

<div class="container">
            
            	<!-- Statistics Button Container -->
            	
                
                <!-- Panels Start -->
                
            	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>商品添加</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<form class="mws-form" action="/adminshop" method="post" enctype="multipart/form-data">
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">商品名:</label>
                    				<div class="mws-form-item">
                    					<input type="text" class="small" name="name" value="">
                    				</div>
                    			</div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">类别:</label>
                                    <div class="mws-form-item">
                                        <select name="cate_id" class="small">
                                            <option value="">--请选择--</option>
                                            @foreach($cates as $v)
                                            <option value="{{$v->id}}">{{$v->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">图片:</label>
                                    <div class="mws-form-item">
                                        <input type="file" class="small" name="pic" value="">
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">描述:</label>
                                    <div class="mws-form-item">
                                        <textarea name="descr"></textarea>
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">数量:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="small" name="num" value="">
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">单价:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="small" name="price" value="">
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