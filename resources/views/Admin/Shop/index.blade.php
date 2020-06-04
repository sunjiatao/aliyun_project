@extends('AdminPublic.adminindex')
@section('title','商品列表')
@section('start')
<script type="text/javascript" src="/static/jquery-1.7.2.min.js"></script>
<div class="container">
            
            	<!-- Statistics Button Container -->
       

                
            	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><i class="icon-table"></i> 商品列表</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
                        	<div id="did">
                        	<table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                            <thead>
                                <tr role="row"><th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 132px;">ID</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 182px;">商品名</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 170px;">类别</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 113px;">图片</th>
                                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 113px;">描述</th>
                                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 113px;">数量</th>
                                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 113px;">单价</th>
                                    <th style="width: 200px" class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 82px;">操作</th></tr>
                            </thead>
                            
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                        	@foreach($info as $v)
                        		<tr class="even">
                                    <td class="  sorting_1">{{$v->sid}}</td>
                                    <td class=" ">{{$v->sname}}</td>
                                    <td class=" ">{{$v->cname}}</td>
                                    <td class=" "> <img style="width: 100px;height: 100px;" src="{{$v->pic}}"></td>
                                    <td class=" ">{!!$v->descr!!}</td>
                                    <td class=" ">{{$v->num}}</td>
                                    <td class=" ">{{$v->price}}</td>
                                    
                                    <td class=" " >
                                       
                                          <!--  <a href="/userinfo/id" class="btn btn-success">获取会员详情</a>  -->



                                           <!-- 修改 -->
                                            <a href="/adminshop/{{$v->sid}}/edit"><button type="submit" style="float: left"><i class="icon-pencil"></i></button></a>
                                        
									 <form action="/adminshop/{{$v->sid}}" method="post">	
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
										<button type="submit" style="float: left;"><i class="icon-trash" ></i></button>
                                        <div style="clear: both;"></div>
                                    </form>
                                    </td>
                                    
                                </tr>
						      @endforeach
                            </tbody>
                                </table>
                               </div> 	
                                	<div class="dataTables_paginate paging_full_numbers" id="pages">
                                	

                                		
                                		</div>
                                	
                                </div>
                   		 </div>
                	</div>
                
                <!-- Panels End -->
            </div>
<script type="text/javascript">
    // alert($);
    function page(page){
        // alert(page);
        // Ajax请求
        $.get('/adminuser',{page:page},function(data){
            // alert(data);
            $('#did').html(data);
        });
    }
 </script>     
            	
         
@endsection