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
                                <form class="form-horizontal" role="form" action="<?php echo site_url('group/detail/'.$gid);?>" method="post">
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="group_name"> 用户组名称 </label>
                                    <div class="col-sm-9">
                                        <input type="text" id="group_name" name="group_name" placeholder="用户组名称" class="col-xs-10 col-sm-5" value="<?php echo empty($info['name']) ? '' : $info['name'];?>" />
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="status"> 是否开启 </label>
                                    <div class="col-sm-9">
                                        <label class="radio-inline">
                                            <input name="status" type="radio" class="ace" value="0" <?php if(!isset($info['status']) OR $info['status'] == 0){echo 'checked';}?>/>
                                            <span class="lbl"> 是</span>
                                        </label>
                                        <label class="radio-inline">
                                            <input name="status" type="radio" class="ace" value="1" <?php if(isset($info['status']) && $info['status'] == 1){echo 'checked';}?>/>
                                            <span class="lbl"> 否</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="space-4"></div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="desc"> 页面描述</label>
                                    <div class="col-sm-9">
                                        <textarea class="col-xs-10 col-sm-5" id="desc" placeholder="页面描述" name="desc" rows="5"><?php echo empty($info['description']) ? '' : $info['description'];?></textarea>
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


