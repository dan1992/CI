        <div class="sidebar" id="sidebar">
					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
					</script>

					<div class="sidebar-shortcuts" id="sidebar-shortcuts">
						<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
							<button class="btn btn-success">
								<i class="icon-signal"></i>
							</button>

							<button class="btn btn-info">
								<i class="icon-pencil"></i>
							</button>

							<button class="btn btn-warning">
								<i class="icon-group"></i>
							</button>

							<button class="btn btn-danger">
								<i class="icon-cogs"></i>
							</button>
						</div>

						<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
							<span class="btn btn-success"></span>

							<span class="btn btn-info"></span>

							<span class="btn btn-warning"></span>

							<span class="btn btn-danger"></span>
						</div>
					</div><!-- #sidebar-shortcuts -->

					<ul class="nav nav-list">
						<li <?php if($url == ''):
						              echo 'class="active"';
						          endif;
						    ?>>
							<a href="<?php echo base_url().'admin.php'?>">
								<i class="icon-dashboard"></i>
								<span class="menu-text"> 控制台 </span>
							</a>
						</li>

						<?php 
						      if( ! empty($menu) && is_array($menu)):
						          foreach ($menu as $key => $val):
						              $class = '';
						              if($menu_info['id'] == $val['id'] OR $menu_info['parent_id'] == $val['id']):
						                  $class = 'class="active open"';
						              endif;
						?>
						<li <?php echo $class;?>>
							<a href="<?php echo base_url().'admin.php/'.$val['url'];?>" <?php if( ! empty($val['sub'])){echo 'class="dropdown-toggle"';}?>>
								<i class="<?php echo $val['icon'];?>"></i>
								<span class="menu-text"> <?php echo $val['name'];?> </span>
								<?php if( ! empty($val['sub'])):
								        echo '<b class="arrow icon-angle-down"></b>';
								      endif;
								?>
							</a>
							<?php 
							     if( ! empty($val['sub']) && is_array($val['sub'])):
							?>
							<ul class="submenu">
							     <?php foreach ($val['sub'] as $sub):
							             $class = '';
							             if($menu_info['id'] == $sub['id'] OR $menu_info['parent_id'] == $sub['id']):
							                  $class = 'class="active open"';
							             endif;
							     ?>
								<li <?php echo $class;?>>
									<a href="<?php echo base_url().'admin.php/'.$sub['url'];?>" <?php if( ! empty($sub['sub'])){echo 'class="dropdown-toggle"';}?>>
										<i class="<?php echo $sub['icon'];?>"></i>
										<?php echo $sub['name'];?>
										<?php if( ! empty($sub['sub'])){echo '<b class="arrow icon-angle-down"></b>';}?>
									</a>
									<?php 
									       if( ! empty($sub['sub']) && is_array($sub['sub'])):
									?>
									       <ul class="submenu">
									            <?php foreach ($sub['sub'] as $grand):?>
												<li>
													<a href="<?php echo base_url().'admin.php/'.$grand['url'];?>">
														<i class="<?php echo $grand['icon'];?>"></i>
														<?php echo $grand['name']?>
													</a>
												</li>
												<?php endforeach;?>
											</ul>
									<?php endif;?>
								</li>
								<?php endforeach;?>
							</ul>
							<?php endif;?>
						</li>
                        <?php endforeach;endif;?>
					</ul><!-- /.nav-list -->

					<div class="sidebar-collapse" id="sidebar-collapse">
						<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
					</div>

					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
					</script>
				</div>