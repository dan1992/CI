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
                            <h4>用户组名称：<?php echo $info['name'];?></h4>
                            <h4><input type="checkbox" name="menu_id" value="all" />权限</h4>
                            <!-- 内容  -->
                            <div class="col-xs-12">
                                <?php if (!empty($list) && is_array($list)):
                                        foreach ($list as $key => $value) {
                                ?>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h4 class="header smaller lighter green">
                                            <label>
                                                <input type="checkbox" <?php if (strpos($info['power'], $value['id'].',') !== false) {echo 'checked';}?> name="menu_id" value="<?php echo $value['id'];?>" />
                                            </label>
                                            <font style="vertical-align: inherit;"><?php echo $value['name'];?></font>
                                        </h4>
                                        <?php if (!empty($value['sub']) && is_array($value['sub'])) { ?>
                                        <?php     foreach ($value['sub'] as $kk => $vv) {?>
                                        <label class="checkbox-inline"><input type="checkbox" <?php if (strpos($info['power'], $value['id'].',')) {echo 'checked'}?> name="sub_id" value="<?php echo $vv['id']?>">
                                        <?php echo $vv['name'];?></label>
                                        <?php
                                                   }
                                               }
                                        ?>
                                    </div>
                                </div>
                                <?php
                                        }
                                ?>
                                <?php endif; ?>
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

<script type="text/javascript">
    
</script>
</html>


