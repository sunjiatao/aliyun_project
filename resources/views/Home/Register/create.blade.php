<!DOCTYPE html>
<html>

	<head lang="en">
		<meta charset="UTF-8">
		<title>注册</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="renderer" content="webkit">
		<meta http-equiv="Cache-Control" content="no-siteapp" />

		<link rel="stylesheet" href="/static/Home/AmazeUI-2.4.2/assets/css/amazeui.min.css" />
		<link rel="stylesheet" type="text/css" href="/static/Home/css/bootstrap.min.css">
		<link href="/static/Home/css/dlstyle.css" rel="stylesheet" type="text/css">
		<script src="/static/Home/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
		<script src="/static/Home/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>

	</head>
	<style type="text/css">

		.cur{
			border:1px solid red;
		}
		.curs{
			border:1px solid green;
		}
</style>
	<body>

		<div class="login-boxtitle">
			<a href="/index"><img alt="" src="https://sphp217.oss-cn-beijing.aliyuncs.com/1566365491.jpg" /></a>
			<a href="/homelogin/create" style="position: relative;top: -10px;left: 750px;">已有账号?登录</a>
		</div>

		<div class="res-banner">
			<div class="res-main">
				<div class="login-banner-bg"><span></span><img src="/static/Home/images/big.jpg" /></div>
				<div class="login-box">

						<div class="am-tabs" id="doc-my-tabs">
							<ul class="am-tabs-nav am-nav am-nav-tabs am-nav-justify">
								<li class="am-active"><a href="">邮箱注册</a></li>
								<li><a href="">手机号注册</a></li>
							</ul>

							<div class="am-tabs-bd">
								<div class="am-tab-panel am-active">
									<form method="post" action="/homeregister" id="form">
										
										@if(session('error'))
											{{session('error')}}
										@endif
										
				 <div class="user-email">
										<label for="email"><i class="am-icon-envelope-o"></i></label>

										<input type="email" name="email" id="email" placeholder="请输入邮箱账号">
										
                 </div>	<span id="span"></span>									
                 <div class="user-pass">
								    <label for="password"><i class="am-icon-lock"></i></label>
								    <input type="password" name="password" id="password" placeholder="设置密码">
                 </div>										
                 <div class="user-pass">
								    <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
								    <input type="password" name="repassword" id="passwordRepeat" placeholder="确认密码">
                 </div>	
                 <span id="mima"></span>
                 <div class="verification">
											<label for="code"><i class="am-icon-code-fork"></i></label>
											<input type="tel" name="code" id="code" placeholder="请输入验证码" style="width: 200px;float: left;">
											<img src="/code" onclick="this.src = this.src+'?a=1'" style="float: left;">	
											<div style="clear: both;"></div>
				 </div>	
                 
                 
								  <div class="user-pass">
										<label for="reader-me" style="width: 300px;height:40px;background:#f8f8f8">
											<input id="reader-me" type="checkbox" style="float: left;width: 15px;height: 15px;position: relative;top: 10px;"> 
												<span style="float:left">点击表示您同意商城《服务协议》</span>
											
										</label>
							  	</div>
										<div class="am-cf" ">
												 {{csrf_field()}}
											<input type="submit" name="" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
										</div>
</form>
<script type="text/javascript">
	 e = false;
	 p = false;
	$('#email').blur(function(){
		
		// alert(1);
		// alert($('#email').val());
		email = $('#email').val();
		// this = $(this);
		// alert(email);
		
		$.get('/homeregister',{email:email},function(data){
			// alert(data);
			if(data == '邮箱已存在'){
				$('#span').html(data).css('color','red');
				e = false;
			}else if(data == 1){
				$('#span').html('邮箱不能为空').css('color','red');
				e = false;
			}else if(data == 2){
				$('#span').html('邮箱未激活,请再次注册').css('color','green');
				e = true;
			}else{
				$('#span').html('邮箱可用').css('color','green');
				e = true;
			}
			
		
		});
	
	});
	$('#passwordRepeat').blur(function(){
		password = $('#password').val();
		repassword = $('#passwordRepeat').val();
		if(password != repassword){
			$('#mima').html('两次密码不一致').css('color','red');
			p = false;
		}else{
			$('#mima').html('密码一致').css('color','green');
			p = true;
		}
		
		

		
	}); 



	$('#form').submit(function(){
		if(e  && p ){
			return true;		
		}else{
			return false;
		}				
	})
			
			

</script>
								</div>

								<div class="am-tab-panel">
									<form method="post" action="/registerphone" id="form1">
                 <div class="user-phone">
								    <label for="phone"><i class="am-icon-mobile-phone am-icon-md"></i></label>
								    <input type="tel" class="ll" name="phone" id="phone" placeholder="请输入手机号" reminder="请输入正确的手机号">

                 </div>	
                 <span></span>																		
										<div class="verification">
											<label for="code"><i class="am-icon-code-fork"></i></label>
											<input type="tel" class="ll" name="code" id="ccode" placeholder="请输入验证码" reminder='请输入验证码' style="width: 180px;">
											<a class="btn btn-info" href="javascript:void(0);"  id="sendMobileCode">
												发送</a>
										</div>
										<span></span>
                 <div class="user-pass">
								    <label for="password"><i class="am-icon-lock"></i></label>
								    <input type="password" class="ll" name="password" id="pwd" placeholder="设置密码" reminder='密码1到18位数字字母下滑线'>
                 </div>		
                 <span></span>								
                 <div class="user-pass">
								    <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
								    <input type="password"  class="ll" name="repassword" id="repwd" placeholder="确认密码" reminder='重复确认密码'>
                 </div>	
                 <span></span>
									
								 <div class="user-pass" style="height: 0px;">
										
											<input id="reader-me1" type="checkbox" style="float: left;width: 15px;height: 15px;"> 
												<span style="float:left">点击表示您同意商城《服务协议》</span>
											
										
							  	</div>
										<div class="am-cf">
											{{csrf_field()}}
											<input type="submit" name="" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
											
										</div>
								</form>
									<hr>
								
								</div>
															

								<script>
									$(function() {
									    $('#doc-my-tabs').tabs();
									  })
								</script>

							</div>
						</div>

				</div>
			</div>
			
					<div class="footer ">
						<div class="footer-hd ">
							<p>
								<a href="# ">恒望科技</a>
								<b>|</b>
								<a href="# ">商城首页</a>
								<b>|</b>
								<a href="# ">支付宝</a>
								<b>|</b>
								<a href="# ">物流</a>
							</p>
						</div>
						<div class="footer-bd ">
							<p>
								<a href="# ">关于恒望</a>
								<a href="# ">合作伙伴</a>
								<a href="# ">联系我们</a>
								<a href="# ">网站地图</a>
								<em>© 2015-2025 Hengwang.com 版权所有. 更多模板 <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a></em>
							</p>
						</div>
					</div>
	</body>
<script type="text/javascript">
	// alert($);
	code1 = false;
	phone1 = false;
	$(".ll").focus(function(){
		reminder = $(this).attr('reminder');
		// alert(reminder);
		//找到下一个span元素
		$(this).parent().next('span').css('color','red').html(reminder);
		$(this).removeClass('curs');
	})	
	$("input[name='phone']").blur(function(){
		o = $(this);
		p=$(this).val();
		//正则
		if(p.match(/^\d{11}$/) == null){
			$(this).parent().next('span').css('color','red').html('请输入正确的手机号');
			$(this).addClass('cur');
			phone1 = false;
		}else{
			// alert('ok');
			//校验手机号是否唯一
			$.get('/checkphone',{p:p},function(data){
				// alert(data);
				if(data == 1){
					//手机号已经被注册
					o.parent().next('span').css('color','red').html('手机号已被注册');
					o.addClass('cur');
					$('#sendMobileCode').attr('disabled',true);
					phone1 = false;
				}else{
					o.parent().next('span').css('color','green').html('手机号可用');
					o.addClass('curs');
					$('#sendMobileCode').attr('disabled',false);
					phone1 = true;
				}
			})
		}
	})	
	//获取按钮
	$('#sendMobileCode').click(function(){
		oo=$(this);
		//获取手机号
		pp = $("input[name='phone']").val();
		//ajax
		$.get('/registersendphone',{pp:pp},function(data){
			// alert(data.code);
			if(data.code == 000000){
				//按钮倒计时
				m=60;
				timmer = setInterval(function(){
					m--;
					//赋值给按钮
					oo.html('重新发送('+m+')');
					oo.attr('disabled',true);
					if(m<1){
						clearInterval(timmer);
						oo.html('重新发送');
						oo.attr('disabled',false);
					}
				},1000)
			}
		},'json');
	})	
	//检测短信校验码
	$("input[name='code']").blur(function(){
		cc = $(this);
		code = $(this).val();
		//ajax
		$.get('/checkcode',{code:code},function(data){
			// alert(data);
			if(data==1){
				cc.parent().next('span').css('color','green').html('校验码正确');
					cc.addClass('curs');
					code1 = true;
			}else if(data == 2){
				cc.parent().next('span').css('color','red').html('校验码有误');
					cc.addClass('cur');
					code1 = false;
			}else if(data == 3){
				cc.parent().next('span').css('color','red').html('校验码不能位空');
					cc.addClass('cur');
					code1 = false;
			}else if(data == 4){
				cc.parent().next('span').css('color','red').html('校验码过期');
					cc.addClass('cur');
					code1 = false;
			}
		})
	})
	//表单提交
	$('#form1').submit(function(){
		// trigger 让匹配道德元素触发某类事件
		$('input').trigger('blur');
		if(phone1 && code1){
			return true;
		}else{
			return false;
		}
	})
	alert('手机号短信注册暂时不能使用');
</script>	
</html>
