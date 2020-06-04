@extends('AdminPublic.adminindex')
@section('title','分类列表')
@section('start')
<div class="container">
            
            	<!-- Statistics Button Container -->
       

                
            	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><i class="icon-table"></i> 分类列表</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
                        	<form action="/admincates" method="get">
                        	<div class="dataTables_filter" id="DataTables_Table_1_filter">
							
                        		<label>名字: <input type="text" aria-controls="DataTables_Table_1" name="keywords" value="{{$request['keywords'] or ''}}">
									<input type="submit" value="搜索" name="">
                        		</label>
                        	
                        		</div>
							</form>
                        	<table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                            <thead>
                                <tr role="row"><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 182px;"> name</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 170px;">pic</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 82px;">操作</th></tr>
                            </thead>
                            
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                        	@foreach($data as $v)
                        		<tr class="even">
                                    
                                    <td class=" ">{{$v->name}}</td>
                                    
                                    <td class=" "><img src="{{$v->pic}}"></td>
                                    <td class=" " >
                                       
                                            
                                            <a href="/adminlunbo/{{$v->id}}/edit"><button type="submit" style="float: left"><i class="icon-pencil"></i></button></a>
                                     </td>   
									
                                    
                                    
                                </tr>
							@endforeach
                            </tbody>
                                </table>
                                	
                                	<div class="dataTables_paginate paging_full_numbers" id="pages">
                                		
										

                                		
                                		</div>
                                	
                                </div>
                   		 </div>
                	</div>
                
                <!-- Panels End -->
            </div>
                
            	
         
@endsection