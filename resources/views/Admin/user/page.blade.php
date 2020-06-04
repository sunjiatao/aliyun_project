                    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
                        	<div id="did">
                        	<table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                            <thead>
                                <tr role="row"><th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 132px;">ID</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 182px;">用户名</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 170px;">邮箱</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 113px;">状态</th>
                                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 113px;">添加时间</th>
                                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 113px;">修改时间</th>
                                    <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 200px;">操作</th></tr>
                            </thead>
                            
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                        	@foreach($data as $v)
                        		<tr class="even">
                                    <td class="  sorting_1">{{$v->id}}</td>
                                    <td class=" ">{{$v->name}}</td>
                                    <td class=" ">{{$v->email}}</td>
                                    <td class=" ">{{$v->status}}</td>
                                    <td class=" ">{{$v->created_at}}</td>
                                    <td class=" ">{{$v->updated_at}}</td>
                                    
                                    <td class=" " >
                                       
                                           <a title="收货地址" href="/useraddress/{{$v->id}}" ><button style="float: left"><i class="icon-truck"></i></button></a> 
                                           <!-- 修改 -->
                                            <a href="/adminuser/{{$v->id}}/edit"><button type="submit" style="float: left"><i class="icon-pencil"></i></button></a>
                                        
									 <form action="/adminuser/{{$v->id}}" method="post">	
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
                                	
                
                                	
                                </div>