<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>登录 —— CI后台管理系统</title>
		<meta name="keywords" content="CI后台管理系统" />
		<meta name="description" content="CI后台管理系统" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<base href="<?php echo $base_url.'application/Admin/views/'; ?>" />
		<!-- basic styles -->

		<link href="static/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="static/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="static/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!-- page specific plugin styles -->

		<!-- ace styles -->

		<link rel="stylesheet" href="static/css/ace.min.css" />
		<link rel="stylesheet" href="static/css/ace-rtl.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="static/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="static/js/html5shiv.js"></script>
		<script src="static/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="login-layout">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<i class="icon-leaf green"></i>
									<span class="red">ACE</span>
									<span class="white">CI后台管理系统</span>
								</h1>
								<h4 class="blue">&copy; 983928220@qq.com</h4>
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="icon-coffee green"></i>
												欢迎使用CI后台管理系统
											</h4>

											<div class="space-6"></div>
                                            <?php echo validation_errors();?>
                                            <p style="color: red"><?php echo $message;?></p>
											<form action="<?php echo base_url();?>admin.php/login/" method="post">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" name="username" class="form-control" placeholder="用户名" />
															<i class="icon-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" name="password" class="form-control" placeholder="密码" />
															<i class="icon-lock"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="" name="yzm" placeholder="验证码" />
															<img alt="" src="<?php echo base_url().'admin.php/login/verify'?>" title="" onclick="this.src = '<?php echo base_url();?>admin.php/login/verify?'+new Date().getTime()" />
														</span>
													</label>
													
													<div class="space"></div>

													<div class="clearfix">
														<label class="inline">
															<input type="checkbox" class="ace" />
															<span class="lbl"> 记住我</span>
														</label>
                                                        <input name="login" type="hidden" value="login">
														<button id="login" type="submit" class="width-35 pull-right btn btn-sm btn-primary">
															<i class="icon-key"></i>
															登录
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>

											<div class="social-or-login center">
												<span class="bigger-110">其他登录方式</span>
											</div>

											<div class="social-login center">
											    <a class="btn btn-primary">
													<i class="icon-comments"></i>
												</a>
												<a class="btn btn-primary">
													<i class="icon-pinterest-sign"></i>
												</a>
											</div>
										</div><!-- /widget-main -->

										<div class="toolbar clearfix">
											<div>
												<a href="#" onclick="show_box('forgot-box'); return false;" class="forgot-password-link">
													<i class="icon-arrow-left"></i>
													忘记密码
												</a>
											</div>

											<div>
												<a href="#" onclick="show_box('signup-box'); return false;" class="user-signup-link">
													注册
													<i class="icon-arrow-right"></i>
												</a>
											</div>
										</div>
									</div><!-- /widget-body -->
								</div><!-- /login-box -->

								<div id="forgot-box" class="forgot-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header red lighter bigger">
												<i class="icon-key"></i>
												找回密码
											</h4>

											<div class="space-6"></div>
											<p>
												输入您的电子邮件并接收指令
											</p>

											<form>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" name="email" class="form-control" placeholder="邮箱" />
															<i class="icon-envelope"></i>
														</span>
													</label>

													<div class="clearfix">
														<button id="retrievepw" type="button" class="width-35 pull-right btn btn-sm btn-danger">
															<i class="icon-lightbulb"></i>
															发送
														</button>
													</div>
												</fieldset>
											</form>
										</div><!-- /widget-main -->

										<div class="toolbar center">
											<a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link">
												返回登陆
												<i class="icon-arrow-right"></i>
											</a>
										</div>
									</div><!-- /widget-body -->
								</div><!-- /forgot-box -->
								<div id="signup-box" class="signup-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header green lighter bigger">
												<i class="icon-group blue"></i>
												新用户注册
											</h4>

											<div class="space-6"></div>
											<p> 输入您的详细信息: </p>

											<form action="" method="post">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" name="regemail" class="form-control" placeholder="邮箱" />
															<i class="icon-envelope"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" name="regusername" class="form-control" placeholder="用户名" />
															<i class="icon-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" name="regpassword" class="form-control" placeholder="密码" />
															<i class="icon-lock"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" name="regreppw" class="form-control" placeholder="重新输入" />
															<i class="icon-retweet"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" name="captcha" class="" placeholder="验证码" />
															<img id="regyzm" alt="" src="" title=""  onclick="getcaptcha();"/>
														</span>
													</label>
													
													<label class="block">
														<input type="checkbox" class="ace" />
														<span class="lbl">
															我接受
															<a href="#">用户协议</a>
														</span>
													</label>

													<div class="space-24"></div>

													<div class="clearfix">
														<button type="reset" class="width-30 pull-left btn btn-sm">
															<i class="icon-refresh"></i>
															重置
														</button>

														<button id="register" type="button"  class="width-65 pull-right btn btn-sm btn-success">
															注册
															<i class="icon-arrow-right icon-on-right"></i>
														</button>
													</div>
												</fieldset>
											</form>
										</div>

										<div class="toolbar center">
											<a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link">
												<i class="icon-arrow-left"></i>
												返回登录
											</a>
										</div>
									</div><!-- /widget-body -->
								</div><!-- /signup-box -->
							</div><!-- /position-relative -->
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div>
		</div><!-- /.main-container -->

		<!-- basic scripts -->


		<!--[if !IE]> -->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='static/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='static/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='static/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->

		<script type="text/javascript">
			function show_box(id) {
			 jQuery('.widget-box.visible').removeClass('visible');
			 jQuery('#'+id).addClass('visible');
			}
		</script>
<script type="text/javascript">
//注册时的验证码
getcaptcha();
function getcaptcha(){
	$.post('<?php echo base_url();?>admin.php/login/regverify?'+Math.random(),'',function(data){
        var data = eval('('+data+')');
        
        if (data.status == 1) {
        	console.log(data)
            $('#regyzm').attr('src', 'static/captcha/'+data.verify['filename']);
        }
    });
}

/* //登录
$('#login').click(function(){
	
}); */

//注册
$('#register').click(function(){
	var email = $('input[name="regemail"]').val();
	var name  = $('input[name="regusername"]').val();
	var passw = $('input[name="regpassword"]').val();
	var reppw = $('input[name="regreppw"]').val();
	var yzm   = $('input[name="captcha"]').val();

	if(email == '' || email == null){
	    alert('用户名不能为空');
	    return false;
	}

	if(name == '' || name == null){
	    alert('用户名不能为空');
	    return false;
	}

	if(passw.length < 6 || passw.length > 16){
	    alert('请设置6-16位的密码');
	    return false;
	}

	if(reppw != passw){
		alert('请确保两次密码一致');
		return false;
	}

	if(yzm == '' || yzm == null){
	    alert('验证码不能为空');
	    return false;
	}

	var info = {'regemail':email, 'regusername':name, 'regpassword':passw, 'regreppw':reppw, 'captcha':yzm};
	$.post('<?php echo site_url('login/register');?>', info, function(data){
		var data = eval('('+data+')');
		console.log(data);
		if(data.status == 1){
			alert('注册成功');
			setTimeout('window.location.href="<?php echo base_url().'admin.php';?>";',2000);
		}else{
		    alert(data.info);
		    return false;
		}
	});
});
</script>
</body>
</html>
