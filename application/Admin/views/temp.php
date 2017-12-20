<?php include_once set_realpath(APPPATH.'views/public/header.php');?>
	<body>
		<?php include_once set_realpath(APPPATH.'views/public/navbar.php');?>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<div class="main-container-inner">
				<a class="menu-toggler" id="menu-toggler" href="#">
					<span class="menu-text"></span>
				</a>

				<?php include_once set_realpath(APPPATH.'views/public/sidebar.php');?>
				<div class="main-content">
					<?php include_once set_realpath(APPPATH.'views/public/breadcrumb.php');?>

					<div class="page-content">
						<div class="page-header">
							<h1>
								控制台
								<small>
									<i class="icon-double-angle-right"></i>
									查看
								</small>
							</h1>
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-xs-12">
							<!-- 内容 -->
							</div>
						</div>
					</div><!-- /.page-content -->
				</div><!-- /.main-content -->
			</div><!-- /.main-container-inner -->

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="icon-double-angle-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<?php include_once set_realpath(APPPATH.'views/public/footer.php');?>

</body>
</html>

