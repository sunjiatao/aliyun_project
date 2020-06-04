@extends('AdminPublic.adminindex')
@section('title','友情链接列表')
@section('start')
<div class="container">
            
            	<!-- Statistics Button Container -->
       

                
            	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><i class="icon-table"></i> 友情链接列表</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
                        	<form action="/admincates" method="get">
                        	<div class="dataTables_filter" id="DataTables_Table_1_filter">
							
                        		<label>友情链接: <input type="text" aria-controls="DataTables_Table_1" name="keywords" value="{{$request['keywords'] or ''}}">
									<input type="submit" value="搜索" name="">
                        		</label>
                        	
                        		</div>
							</form>
                        	<table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                            <thead>
                                <tr role="row"><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 182px;"> 网站名称</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 170px;">网址</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 170px;">联系人</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 170px;">联系邮箱</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 170px;">申请人</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 170px;">简介</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 170px;">状态</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 82px;">操作</th></tr>
                            </thead>
                            
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                        	@foreach($data as $v)
                        		<tr class="even">
                                    
                                    <td class=" ">{{$v->name}}</td>
                                    
                                    <td class=" ">{{$v->url}}</td>
                                    <td class=" ">{{$v->linkman}}</td>
                                    <td class=" ">{{$v->email}}</td>
                                    <td class=" ">{{$v->applicant}}</td>
                                    <td class=" ">{{$v->memo}}</td>
                                    @if($v->status==0)
                                    <td class=" ">不通过</td>
                                    @else
                                    <td class=" ">通过</td>
                                    @endif
                                     <td class=" " >
                                       
                                            
                                            <a href="/adminhezuo1/{{$v->id}}/edit"><button type="submit" style="float: left"><i class="icon-pencil"></i></button></a>
                                            <form action="/adminhezuo1/{{$v->id}}" method="post">    
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
                                	
                                	<div class="dataTables_paginate paging_full_numbers" id="pages">
                                		
										

                                		
                                		</div>
                                	
                                </div>
                   		 </div>
                	</div>
                
                <!-- Panels End -->
            </div>
                
            	
         
@endsection