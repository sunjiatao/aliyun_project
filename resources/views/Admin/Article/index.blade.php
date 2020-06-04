@extends('AdminPublic.adminindex')
@section('title','公告列表')
@section('start')
<script type="text/javascript" src="/static/jquery-1.7.2.min.js"></script>
<div class="container">
            
            	<!-- Statistics Button Container -->
       

                
            	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><i class="icon-table"></i> 公告列表</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
                        	
                        	<table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                            <thead>
                                <tr role="row"><th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 132px;"> </th><th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 132px;">ID</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 170px;">描述</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 170px;">图片</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 170px;">作者</th><th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 82px;">操作</th></tr>
                            </thead>
                            
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                        	@foreach($info as $v)
                        		<tr class="even">
                                    <td><input type="checkbox" value="{{$v['id']}}" name=""></td>
                                    <td class="  sorting_1">{{$v['id']}}</td>
                                    <td class=" ">{{$v['title']}}</td>
                                   
                                    
                                    <td class=" "><img style="width: 50px;height: 50px;" src="{{$v['thumb']}}"></td>
                                    <td class=" ">{{$v['editor']}}</td>
                                    <td class=" " >
                                       
                                       <!-- 修改      -->
                                    <a href="/adminusers/{{$v['id']}}/edit"><button style="float: left" ><i class="icon-pencil"></i></button></a>        
                                        
									
                                    </td>
                                    
                                </tr>
							@endforeach
                            <tr ><td colspan='8'><a href="JavaScript:void(0)" class="btn btn-success  allchoose">全选</a><a href="JavaScript:void(0)" class="btn btn-success nochoose">全不选</a><a href="JavaScript:void(0)" class="btn btn-success fchoose">反选</a></td></tr>
                            <tr><td colspan="8"><a href="javascript:void(0)" class="btn tbn-danger del">删除</a></td></tr>
                            </tbody>
                                </table>
                                	
                                	<div class="dataTables_paginate paging_full_numbers" id="pages">
                                		
										
                                		
                                		</div>
                                	
                                </div>
                   		 </div>
                	</div>
                
                <!-- Panels End -->
            </div>
<script type="text/javascript">

    // alert($);
    $('.allchoose').click(function(){
        $('table').find('tr').each(function(){
            // alert(1);
            $(this).find(':checkbox').attr('checked',true);
        });
    })

    //全不选
    $('.nochoose').click(function(){
        $('table').find('tr').each(function(){
            // alert(1);
            $(this).find(':checkbox').attr('checked',false);
        });
    })

    //反选
    $('.fchoose').click(function(){
        $('table').find('tr').each(function(){
            // alert(1);
            if($(this).find(':checkbox').attr('checked')){
                //取消选中
                $(this).find(':checkbox').attr('checked',false);
            }else{
                $(this).find(':checkbox').attr('checked',true);
            }
        });
    })

    //删除
    $('.del').click(function(){
        arr = [];
        //获取选中的数据id
        $('table').find('tr').each(function(){
            if($(this).find(":checkbox").attr('checked')){
                id = $(this).find(':checkbox').val();
                //把选中数据的id添加到数组里
                arr.push(id);
            }
        })
        $.get('/articledel',{arr:arr},function(data){
            // alert(data);
            if(data==1){
                //删除选中tr
                for(var i=0;i<arr.length;i++){
                    $("input[value="+arr[i]+"]").parents('tr').remove();

                } 
                alert('删除成功');

            }
        })
    })
</script>
            	
         
@endsection
