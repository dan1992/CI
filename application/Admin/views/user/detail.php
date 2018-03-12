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
                    <?php if( ! empty($message)){?>
                        <div class="alert alert-info">
                            <i class="icon-hand-right"></i>
                            <?php echo $message;?>
                            <button class="close" data-dismiss="alert">
                                <i class="icon-remove"></i>
                            </button>
                        </div>
                    <?php }?>
                        <div class="row">
                        <!-- 内容  -->
                            <div class="col-xs-12">
                                <form class="form-horizontal" role="form" action="<?php echo site_url('user/detail/'.$uid); ?>" method="post">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="username"> 用户名 </label>
                                    <div class="col-sm-9">
                                        <input type="text" id="username" name="username" placeholder="用户名" class="col-xs-10 col-sm-5" value="<?php echo empty($info['username']) ? '' : $info['username'];?>" />
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="realname"> 真实姓名 </label>
                                    <div class="col-sm-9">
                                        <input type="text" id="realname" name="realname" placeholder="真实姓名" class="col-xs-10 col-sm-5" value="<?php echo empty($info['realname']) ? '' : $info['realname'];?>" />
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="email"> 邮箱 </label>
                                    <div class="col-sm-9">
                                        <input type="text" id="email" name="email" placeholder="邮箱地址" class="col-xs-10 col-sm-5" value="<?php echo empty($info['email']) ? '' : $info['email'];?>" />
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="phone"> 手机号 </label>
                                    <div class="col-sm-9">
                                        <input type="text" id="phone" name="phone" placeholder="手机号" class="col-xs-10 col-sm-5" value="<?php echo empty($info['phone']) ? '' : $info['phone'];?>"/>
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-sm-3 col- control-label no-padding-right" for="groupid"> 用户组 </label>
                                    <div class="col-sm-9">
                                        <select class="col-xs-10 col-sm-5" id="groupid" name="groupid">
                                            <option value="0">选择用户组</option>
                                            <?php if (!empty($group) && is_array($group)) {
                                                     foreach ($group as $key => $val):
                                            ?>
                                            <option <?php if (isset($info['groupid']) && $info['groupid'] == $val['id']) {echo 'selected';}?> value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
                                            <?php endforeach;}?>
                                        </select>
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="password"> 密码 </label>
                                    <div class="col-sm-9">
                                        <input type="password" id="password" name="password" placeholder="密码" class="col-xs-10 col-sm-5" value="<?php echo empty($info['password']) ? '' : $info['password'];?>"/>
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <div class="col-md-offset-4 col-md-8">
                                        <button class="btn btn-info" type="submit" name="submit">
                                            <i class="icon-ok bigger-110"></i>
                                            保存
                                        </button>
                                        &nbsp; &nbsp; &nbsp;
                                        <button class="btn" type="reset">
                                            <i class="icon-undo bigger-110"></i>
                                            取消
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

</body>
</html>

