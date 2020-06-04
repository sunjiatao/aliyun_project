@extends('AdminPublic.adminindex')
@section('title','公告添加')
@section('start')
<script type="text/javascript" charset="utf-8" src="/static/Admin/ueditor/ueditor.config.js"></script> <script type="text/javascript" charset="utf-8" src="/static/Admin/ueditor/ueditor.all.min.js"> </script> 
<script type="text/javascript" charset="utf-8" src="/static/Admin/ueditor/lang/zh-cn/zh-cn.js"> </script>
<div class="container">
            
            	<!-- Statistics Button Container -->
            	
                
                <!-- Panels Start -->
                
            	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>公告添加</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<form class="mws-form" action="/article" method="post" enctype="multipart/form-data">
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">标题:</label>
                    				<div class="mws-form-item">
                    					<input type="text" class="small" name="title" value="">
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">作者:</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="small" name="editor" value="">
                                    </div>
                                </div>
                    			<div class="mws-form-row">
                                    <label class="mws-form-label">图片:</label>
                                    <div class="mws-form-item">
                                        <input type="file" class="small" name="thumb" value="">
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">描述:</label>
                                    <div class="mws-form-item">
                                        <script id="editor" type="text/plain" name="descr" style="width:750px;height:500px;"> </script>
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
                <script type="text/javascript"> 
                //实例化编辑器 
                    var ue = UE.getEditor('editor'); 
                </script>
            	
@endsection