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
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="#">首页</a>
							</li>
							<li class="active">控制台</li>
						</ul><!-- .breadcrumb -->

						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="icon-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- #nav-search -->
					</div>

					<div class="page-content">
						<div class="page-header">
						<div class="alert alert-info">
                            <i class="icon-hand-right"></i>
                            <?php echo $message;?>
    						<button class="close" data-dismiss="alert">
    							<i class="icon-remove"></i>
    						</button>
						</div>
						</div><!-- /.page-header -->
						<div class="row">
    					    <div class="col-xs-12">
    					    <!-- 内容 -->
    					    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url().'admin.php/Custommenu/'?>">
    					       <h3 class="header smaller lighter green">菜单一</h3>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="menu_1">名称</label>
										<div class="col-sm-9">
											<input type="text" id="menu_1" name="menu1" placeholder="菜单名称" class="col-xs-10 col-sm-5" />
											<span class="help-inline col-xs-12 col-sm-7" onclick="menu(1)">
											 <i class="icon-plus smaller-120" data-icon-hide="icon-minus" data-icon-show="icon-plus"></i>
											     子菜单
											 </span>
										</div>
									</div>
									<div class="space-4"></div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="type_1">类型</label>
										<div class="col-sm-9">
											<input type="text" id="type_1" name="type1"  placeholder="类型" class="col-xs-10 col-sm-5" />
										</div>
									</div>
									<div class="space-4"></div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="keyurl_1">URL或关键字 </label>
										<div class="col-sm-9">
											<input type="text" id="keyurl_1" name="keyurl1" placeholder="URL或关键字" class="col-xs-10 col-sm-5" />
										</div>
									</div>
									<div class="space-4"></div>
									<div class="row" id="menu_sub_1">
    									
								    </div>
                                    <h3 class="header smaller lighter green">菜单二</h3>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="menu_2"> 名称</label>

										<div class="col-sm-9">
											<input type="text" id="menu_2" name="menu2" placeholder="菜单名称" class="col-xs-10 col-sm-5" />
											<span class="help-inline col-xs-12 col-sm-7" onclick="menu(2)">
											 <i class="icon-plus smaller-120" data-icon-hide="icon-minus" data-icon-show="icon-plus"></i>
											 子菜单
											 </span>
										</div>
									</div>

									<div class="space-4"></div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="type_2"> 类型</label>

										<div class="col-sm-9">
											<input type="text" id="type_2" name="type2" placeholder="类型" class="col-xs-10 col-sm-5" />
										</div>
									</div>

									<div class="space-4"></div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="keyurl_2"> URL或关键字</label>

										<div class="col-sm-9">
											<input type="text" id="keyurl_2" name="keyurl2" placeholder="URL或关键字" class="col-xs-10 col-sm-5" />
										</div>
									</div>

									<div class="space-4"></div>
									<div class="row" id="menu_sub_2">
    									
    								</div>
                                    <h3 class="header smaller lighter green">菜单三</h3>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="menu_3"> 名称 </label>
										<div class="col-sm-9">
											<input type="text" id="menu_3" name="menu3" placeholder="菜单名称" class="col-xs-10 col-sm-5" />
											<span class="help-inline col-xs-12 col-sm-7" onclick="menu(3)">
											 <i class="icon-plus smaller-120" data-icon-hide="icon-minus" data-icon-show="icon-plus"></i>
											 子菜单
											</span>
										</div>
									</div>
									<div class="space-4"></div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="type_3"> 类型 </label>
										<div class="col-sm-9">
											<input type="text" id="type_3" name="type3" placeholder="类型" class="col-xs-10 col-sm-5" />
										</div>
									</div>
									<div class="space-4"></div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="keyurl_3"> URL或关键字 </label>
										<div class="col-sm-9">
											<input type="text" id="keyurl_3" name="keyurl3" placeholder="URL或关键字" class="col-xs-10 col-sm-5" />
										</div>
									</div>
									<div class="space-4"></div>
									<div class="row" id="menu_sub_3">
    									
								    </div>
                                    <div class="clearfix form-actions">
        								<div class="col-md-offset-3 col-md-9">
        									<button class="btn btn-info" type="submit">
        										<i class="icon-ok bigger-110"></i>
        										保存
        									</button>
        									&nbsp; &nbsp; &nbsp;
        									<button class="btn" type="reset">
        										<i class="icon-undo bigger-110"></i>
        										返回
        									</button>
        								</div>
                                    </div>
                                </form>
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
<script type="text/javascript">
//子菜单
function menu(menu_id)
{
	var leng = $('#menu_sub_'+menu_id).children().length;
	var class_name = '';
	
	if(leng == 0)
	{
	    class_name = 'col-sm-offset-1 ';
	}
	
	if(leng > 4){
		alert('一级菜单最多包含5个二级菜单');
	    return false;
	}
    var html = '<div class="'+class_name+'col-xs-10 col-sm-2 pricing-box">';
	    html += '	<div class="widget-box">';
	    html += '<div class="widget-header header-color-green">';
		html += '<h5 class="bigger lighter">子菜单</h5>';
		html += '<span class="widget-toolbar"><a href="#" data-action="close"><i class="icon-remove"></i></a></span>';
		html += '</div>';
	    html += '<div class="widget-body">';
	    html += '<div class="widget-main">';
	    html += '	<div class="form-group">';
	    html += '		<label class="col-sm-3 control-label no-padding-right"> 名称 </label>';
	    html += '		<div class="col-sm-9">';
	    html += '			<input type="text" name="menu_'+menu_id+'[]" placeholder="菜单名称" class="col-xs-10 col-sm-10" />';
	    html += '		</div>';
	    html += '	</div>';
	    html += '	<div class="space-4"></div>';
	    html += '	<div class="form-group">';
	    html += '		<label class="col-sm-3 control-label no-padding-right"> 类型 </label>';
	    html += '		<div class="col-sm-9">';
	    html += '			<input type="text" name="type_'+menu_id+'[]" placeholder="类型" class="col-xs-10 col-sm-10" />';
	    html += '		</div>';
	    html += '	</div>';
	    html += '	<div class="space-4"></div>';
	    html += '	<div class="form-group">';
	    html += '		<label class="col-sm-3 control-label no-padding-right"> URL或关键字 </label>';
	    html += '		<div class="col-sm-9">';
	    html += '			<input type="text" name="keyurl_'+menu_id+'[]" placeholder="URL或关键字" class="col-xs-10 col-sm-10" />';
	    html += '		</div>';
	    html += '	</div>';
	    html += '	<div class="space-4"></div>';
	    html += '</div>'
	    html += '</div>';
	    html += '</div>';
	    html += '</div>';
	    $('#menu_sub_'+menu_id).append(html);

	    $.each($('#menu_sub_'+menu_id).children(), function(index, content){
		    var ch = $(content).children().length;
		    if(ch == 0)
		    {
		        $(content).remove();
			}
		});
}

</script>
</body>
</html>