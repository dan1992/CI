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
							
						</div><!-- /.page-header -->
                        <div class="row">
                            <!-- 内容 -->
                          <div class="col-xs-12">
                            <div class="table-responsive">
                            	<table id="sample-table-1" class="table table-striped table-bordered table-hover">
                            		<thead>
                            			<tr>
                            				<th class="center">
                            					<label>
                            						<input type="checkbox" class="ace" />
                            						<span class="lbl"></span>
                            					</label>
                            				</th>
                            				<th>菜单名称</th>
                            				<th>链接</th>
                            				<th>ICON图标</th>
                            				<th class="hidden-480">状态</th>
                            				<th>排序</th>
                            				<th>描述</th>
                            				<th class="hidden-480">操作</th>
                            			</tr>
                            		</thead>
                            
                            		<tbody>
                            		<?php if( ! empty($list) && is_array($list)){
                            		          foreach ($list as $val):
                            		?>
                            			<tr>
                            				<td class="center">
                            					<label>
                            						<input type="checkbox" class="ace" />
                            						<span class="lbl"></span>
                            					</label>
                            				</td>
                            				<td><?php echo $val['name'];?></td>
                            				<td><?php echo $val['url'];?></td>
                            				<td class="hidden-480"><i class="<?php echo $val['icon'];?> bigger-120"></i></td>
                            				<td><?php echo $val['status'] == 0 ? '显示' : '隐藏';?></td>
                            				<td><?php echo $val['sort'];?></td>
                                            <td><?php echo $val['description'];?></td>
                            				<td>
                            					<div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                            						<a href="<?php echo base_url().'admin.php/menu/detail/'.$val['id']?>">
                            						<button class="btn btn-xs btn-info">
                            							<i class="icon-edit bigger-120"></i>
                            							编辑
                            						</button>
                                                    </a>
                                                    <a>
                            						<button class="btn btn-xs btn-danger" onclick="del_menu(<?php echo $val['id'];?>,this)">
                            							<i class="icon-trash bigger-120"></i>
                            							删除
                            						</button>
                            						</a>
                            					</div>
                            				</td>
                            			</tr>
                            			<?php if( ! empty($val['sub']) && is_array($val['sub'])){
                            			         foreach ($val['sub'] as $sub):
                            			?>
                            			<tr>
                            				<td class="center">
                            					<label>
                            						<input type="checkbox" class="ace" />
                            						<span class="lbl"></span>
                            					</label>
                            				</td>
                            				<td>-- <?php echo $sub['name'];?></td>
                            				<td><?php echo $sub['url'];?></td>
                            				<td class="hidden-480"><i class="<?php echo $sub['icon'];?> bigger-120"></i></td>
                            				<td><?php echo $sub['status'] == 0 ? '显示' : '隐藏';?></td>
                            				<td><?php echo $sub['sort'];?></td>
                                            <td><?php echo $sub['description'];?></td>
                            				<td>
                            					<div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                            						<a href="<?php echo base_url().'admin.php/menu/detail/'.$sub['id']?>">
                            						<button class="btn btn-xs btn-info">
                            							<i class="icon-edit bigger-120"></i>
                            							编辑
                            						</button>
                                                    </a>
                                                    <a>
                            						<button class="btn btn-xs btn-danger" onclick="del_menu(<?php echo $sub['id'];?>,this)">
                            							<i class="icon-trash bigger-120"></i>
                            							删除
                            						</button>
                            						</a>
                            					</div>
                            				</td>
                            			</tr>
                            			<?php if( ! empty($sub['sub']) && is_array($sub['sub'])){
                            			         foreach ($sub['sub'] as $grand):
                            			?>
                            			<tr>
                            				<td class="center">
                            					<label>
                            						<input type="checkbox" class="ace" />
                            						<span class="lbl"></span>
                            					</label>
                            				</td>
                            				<td>---- <?php echo $grand['name'];?></td>
                            				<td><?php echo $grand['url'];?></td>
                            				<td class="hidden-480"><i class="<?php echo $grand['icon'];?> bigger-120"></i></td>
                            				<td><?php echo $grand['status'] == 0 ? '显示' : '隐藏';?></td>
                            				<td><?php echo $grand['sort'];?></td>
                                            <td><?php echo $grand['description'];?></td>
                            				<td>
                            					<div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                            						<a href="<?php echo base_url().'admin.php/menu/detail/'.$grand['id']?>">
                            						<button class="btn btn-xs btn-info">
                            							<i class="icon-edit bigger-120"></i>
                            							编辑
                            						</button>
                                                    </a>
                                                    <a>
                            						<button class="btn btn-xs btn-danger" onclick="del_menu(<?php echo $grand['id'];?>,this)">
                            							<i class="icon-trash bigger-120"></i>
                            							删除
                            						</button>
                            						</a>
                            					</div>
                            				</td>
                            			</tr>
                            			<?php endforeach;}?>
                            			<?php endforeach;}?>
                                        <?php endforeach;}?>
                            		</tbody>
                            	</table>
                            </div><!-- /.table-responsive -->
                        </div><!-- /span -->
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
function del_menu(menu_id, obj)
{

	if(confirm('确定要删除吗？')){
		$.post('<?=base_url()?>admin.php/menu/del/'+menu_id, function(data){
	        var data = eval('('+data+')');
	        if(data.status == 1)
	        {
	        	$(obj).parents('tr').remove();
	            alert('删除成功');
	            return false;
	        }
	        else
	        {
	            alert('删除失败');
	            return false;
	        }
	    });
	    return true;
	}
	else
	{
	    return false;
	}
    
}
</script>
</body>
</html>

