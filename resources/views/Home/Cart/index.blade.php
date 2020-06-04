@extends('HomePublic.HomeIndex')
@section('title','购物车页面')
@section('start')
<link href="/static/Home/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
		<link href="/static/Home/basic/css/demo.css" rel="stylesheet" type="text/css" />
		<link href="/static/Home/css/cartstyle.css" rel="stylesheet" type="text/css" />
		<link href="/static/Home/css/optstyle.css" rel="stylesheet" type="text/css" />

		<script type="text/javascript" src="/static/Home/js/jquery.js"></script>
<!--购物车 -->
			<div class="concent">
				<div id="cartTable">
					<div class="cart-table-th">
						<div class="wp">
							<div class="th th-chk">
								<div id="J_SelectAll1" class="select-all J_SelectAll">

								</div>
							</div>
							<div class="th th-item">
								<div class="td-inner">商品信息</div>
							</div>
							<div class="th th-price">
								<div class="td-inner">单价</div>
							</div>
							<div class="th th-amount">
								<div class="td-inner">数量</div>
							</div>
							<div class="th th-sum">
								<div class="td-inner">金额</div>
							</div>
							<div class="th th-op">
								<div class="td-inner">操作</div>
							</div>
						</div>
					</div>
					<div class="clear"></div>

					<tr class="item-list">
						<div class="bundle  bundle-last ">
							<div class="bundle-hd">
								<div class="bd-promos">
									<div class="bd-has-promo">已享优惠:<span class="bd-has-promo-content">省￥19.50</span>&nbsp;&nbsp;</div>
									<div class="act-promo">
										<a href="#" target="_blank">第二支半价，第三支免费<span class="gt">&gt;&gt;</span></a>
									</div>
									<span class="list-change theme-login">编辑</span>
								</div>
							</div>
							<div class="clear"></div>
							<div class="bundle-main">
								@if(count($data1))
								@foreach($data1 as $v)
								<ul class="item-content clearfix">
									<li class="td td-chk">
										<div class="cart-checkbox ">
											<input class="check" id="J_CheckBox_170037950254" name="items[]" value="{{$v['id']}}" type="checkbox">
											<label for="J_CheckBox_170037950254"></label>
										</div>
									</li>
									<li class="td td-item">
										<div class="item-pic">
											<a href="#" target="_blank" data-title="{{$v['name']}}" class="J_MakePoint" data-point="tbcart.8.12">
												<img src="{{$v['pic']}}" class="itempic J_ItemImg"></a>
										</div>
										<div class="item-info">
											<div class="item-basic-info">
												<a href="#" target="_blank" title="{{$v['name']}}" class="item-title J_MakePoint" data-point="tbcart.8.11">{{$v['name']}}</a>
											</div>
										</div>
									</li>
									<li class="td td-info">
										<div class="item-props item-props-can">
											<span class="sku-line">描述：{!!$v['descr']!!}</span>
											<!-- <span class="sku-line">包装：裸装</span> -->
											<span tabindex="0" class="btn-edit-sku theme-login">修改</span>
											<i class="theme-login am-icon-sort-desc"></i>
										</div>
									</li>
									<li class="td td-price">
										<div class="item-price price-promo-promo">
											<div class="price-content">
												<div class="price-line">
													<em class="price-original">{{$v['price']+299.99}}</em>
												</div>
												<div class="price-line">
													<em class="J_Price price-now" tabindex="0">{{$v['price']}}</em>
												</div>
											</div>
										</div>
									</li>
									<li class="td td-amount">
										<div class="amount-wrapper ">
											<div class="item-amount ">
												<div class="sl">
													<input class="min am-btn bbb" name="jian" type="button" value="-" />
													<input class="text_box " name="{{$v['id']}}" type="text" value="{{$v['num']}} " disabled style="width:30px;" />
													<input class="add am-btn bbb" name="jia" type="button" value="+" />
												</div>
											</div>
										</div>
									</li>
									<li class="td td-sum">
										<div class="td-inner">
											<em tabindex="0" class="J_ItemSum number">{{$v['price']*$v['num']}}</em>
										</div>
									</li>
									<li class="td td-op">
										<div class="td-inner">
											<!-- <a title="移入收藏夹" class="btn-fav" href="#"> -->
                 <!--  移入收藏夹</a>	 -->		<form action="/homecart/{{$v['id']}}" method="post">
														{{csrf_field()}}
														{{method_field('DELETE')}}
                  							
                  							<button class="delete">删除</button>
                 						 </form>
											
										</div>
									</li>
								</ul>
							@endforeach	
							@else
								购物车竟然是空的,再忙也要犒劳自己!!!!!!!!!!!!
							@endif	
								

													
								
								
								
							</div>
						</div>
					</tr>
					<div class="clear"></div>

				
				</div>
				<div class="clear"></div>

				<div class="float-bar-wrapper">
					<div id="J_SelectAll2" class="select-all J_SelectAll">
						<div class="cart-checkbox">
							<input class="check-all check" id="J_SelectAllCbx2" name="select-all" value="true" type="checkbox">
							<label for="J_SelectAllCbx2"></label>
						</div>
						<span>全选</span>
					</div>
					<div class="operations">
						<a href="/alldelete" onclick="return confirm('确定全部删除吗?')" hidefocus="true" class="deleteAll">全部删除</a>
						<a href="/index" hidefocus="true" class="J_BatchFav">继续购物</a>
					</div>
					<div class="float-bar-right">
						<div class="amount-sum">
							<span class="txt">已选商品</span>
							<em id="J_SelectedItemsCount">0</em><span class="txt">件</span>
							<div class="arrow-box">
								<span class="selected-items-arrow"></span>
								<span class="arrow"></span>
							</div>
						</div>
						<div class="price-sum">
							<span class="txt">合计:</span>
							<strong class="price">¥<em id="J_Total">0</em></strong>
						</div>
						<div class="btn-area">
							{{csrf_field()}}
							<!-- <a href="" id="J_Go" class="submit-btn submit-btn-disabled" aria-label="请注意如果没有选择宝贝，将无法结算">
								<span>结&nbsp;算</span></a> -->
							<input style="background-color: #F40;width: 80px;height: 48px;" type="submit" name="" value="结算" class="submit-btn submit-btn-disabled" id="J_Go">
						</div>
					</div>

				</div>
<script type="text/javascript">
	// alert($);
	//减操作
	$("input[name='jian']").click(function(){
		id = $(this).next().attr('name');
		o = $(this);
		$.get('/cartupdate',{id:id},function(data){
			 o.next().val(data.num);
			
			o.parents('li').next('li').find('em').html(data.tot);
			// alert(1);
		},'json')
	})

	//加操作
	$("input[name='jia']").click(function(){
		// alert(1);
		
		id = $(this).prev().attr('name');
		oo=$(this);
		$.get('/cartupdate1',{id:id},function(data){
			// alert(data);
			oo.prev().val(data.num);
			
			oo.parents('li').next('li').find('em').html(data.tot);
		},'json');
	})

	//选择 总计金额
	arr=[];
	$("input[name='items[]']").change(function(){
		if($(this).attr('checked')){
			id = $(this).val();
			arr.push(id);
		}else{
			id1=$(this).val();
			Array.prototype.indexOf = function(val) {
				for (var i = 0; i < this.length; i++) {
				if (this[i] == val) return i;
				}
				return -1;
			};
			Array.prototype.remove = function(val) {
				var index = this.indexOf(val);
				if (index > -1) {
				this.splice(index, 1);
				}
			};
			arr.remove(id1);
		}
		// alert(arr);
		$.get('/homecarttot',{arr:arr},function(data){
			$('#J_SelectedItemsCount').html(data.nums);
			$('#J_Total').html(data.sum);
		},'json');
		


		
	});
	//结算
	$('#J_Go').click(function(){
		if($("input[name='items[]']").is(":checked")){
			
			$.get('/jiesuan',{arr:arr},function(data){
				// alert(data);
				if(data){
					// alert(data);
					window.location="/insert";
				}
			});
		}else{
			alert('还没有选择购买商品');
			return false;
		}
		
	})

	$("input[name='items[]']").click(function(){
		if($("input[name='items[]']").is(':checked')){
			bbb=1
			$.get('/bbb',{bbb:bbb},function(data){
				// alert(data);
				if(data==1){
					$('.bbb').attr('disabled',true);
				}else{
					$('.bbb').attr('disabled',false);
				}
			})
		}else{
			bbb=2
			$.get('/bbb',{bbb:bbb},function(data){
				// alert(data);
				if(data==1){
					$('.bbb').attr('disabled',true);
				}else{
					$('.bbb').attr('disabled',false);
				}
			})
		}
		
	})

</script>
				@endsection