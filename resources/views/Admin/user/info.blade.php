@extends('AdminPublic.adminindex')
@section('title','会员详情')
@section('start')
<div class="container">
            
                <!-- Statistics Button Container -->
       

                
                <div class="mws-panel grid_8">
                    <div class="mws-panel-header">
                        <span><i class="icon-table"></i> 会员详情列表</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
                            
                            <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                            <thead>
                                <tr role="row"><th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 132px;">ID</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 182px;">爱好</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 170px;">性别</th></tr>
                            </thead>
                            
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                            @if(count($info))
                                <tr class="even">
                                    <td class="  sorting_1">{{$info->id}}</td>
                                    <td class=" ">{{$info->hobby}}</td>
                                    <td class=" ">{{$info->sex}}</td>
                                </tr>   
                            @else     
                                <tr class="even">
                                    <td class="  sorting_1" colspan="3">没有数据</td>
                                   
                                </tr>  
                            @endif        
                                
                            
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