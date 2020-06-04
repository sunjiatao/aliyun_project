@extends('AdminPublic.adminindex')
@section('title','会员收货地址')
@section('start')
<div class="container">
            
                <!-- Statistics Button Container -->
       

                
                <div class="mws-panel grid_8">
                    <div class="mws-panel-header">
                        <span><i class="icon-table"></i> 会员收获地址</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
                            
                            <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                            <thead>
                                <tr role="row"><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 182px;">收货人</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 170px;">电话</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 170px;">地址</th>
                                            
                                </tr>
                            </thead>
                            
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                            @if(count($address))
                            @foreach($address as $v)
                                <tr class="even">
                                    <td class="  sorting_1">{{$v->name}}</td>
                                    
                                    <td class=" ">{{$v->phone}}</td>
                                    <td class=" ">{{$v->huo}}</td>
                                </tr>   
                              
                               
                            @endforeach 
                            @else
                                <tr>
                                    <td colspan="3">还没有收获地址</td>
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