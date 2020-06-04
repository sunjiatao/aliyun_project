@extends('AdminPublic.adminindex')
@section('title','权限列表')
@section('start')
<div class="container">
            
                <!-- Statistics Button Container -->
       

                
                <div class="mws-panel grid_8">
                    <div class="mws-panel-header">
                        <span><i class="icon-table"></i> 权限列表</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
                            <form action="/role" method="get">
                            <div class="dataTables_filter" id="DataTables_Table_1_filter">
                            
                                <label>名字: <input type="text" aria-controls="DataTables_Table_1" name="keywords" value="{{$request['keywords'] or ''}}">
                                    <input type="submit" value="搜索" name="">
                                </label>
                            
                                </div>
                            </form>
                            <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                            <thead>
                                <tr role="row"><th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 132px;">ID</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 182px;">权限名</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 182px;">控制器</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 182px;">方法名</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 82px;">操作</th></tr>
                            </thead>
                            
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                            @foreach($auth as $v)
                                <tr class="even">
                                    <td class="  sorting_1">{{$v->id}}</td>
                                    <td class=" ">{{$v->name}}</td>
                                    <td class=" ">{{$v->mname}}</td>
                                    <td class=" ">{{$v->aname}}</td>
                                    
                                   
                                    <td class=" " >
                                      
                                       <!-- 修改      -->
                                    <a href="/auth/{{$v->id}}/edit"><button style="float: left" ><i class="icon-pencil"></i></button></a>        
                                        
                                     <form action="/auth/{{$v->id}}" method="post">   
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button style="float: left;"><i class="icon-trash" ></i></button>
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