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
                                            <th>用户名</th>
                                            <th>真实姓名</th>
                                            <th>邮箱</th>
                                            <th class="hidden-480">手机号</th>
                                            <th>添加时间</th>
                                            <th class="hidden-480">操作</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php if (!empty($list) && is_array($list)) {
                                              foreach ($list as $val):
                                    ?>
                                        <tr>
                                            <td class="center">
                                                <label>
                                                    <input type="checkbox" class="ace" />
                                                    <span class="lbl"></span>
                                                </label>
                                            </td>
                                            <td><?php echo $val['username'];?></td>
                                            <td><?php echo $val['realname'];?></td>
                                            <td><?php echo $val['email'];?></td>
                                            <td><?php echo $val['phone'];?></td>
                                            <td><?php echo $val['addtime'];?></td>
                                            <td>
                                                <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                                                    <a href="<?php echo base_url().'admin.php/user/detail/'.$val['id']?>">
                                                    <button class="btn btn-xs btn-info">
                                                        <i class="icon-edit bigger-120"></i>
                                                        编辑
                                                    </button>
                                                    </a>
                                                    <a>
                                                    <button class="btn btn-xs btn-danger" onclick="del_user(<?php echo $val['id'];?>,this)">
                                                        <i class="icon-trash bigger-120"></i>
                                                        删除
                                                    </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
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
function del_user(user_id, obj)
{
    if (confirm('确定要删除吗？')) {
        $.post('<?=base_url()?>admin.php/user/del/'+user_id, function(data){
            var data = eval('('+data+')');
            if (data.status == 0) {
                $(obj).parents('tr').remove();
                alert('删除成功');
                return false;
            } else {
                alert('删除失败');
                return false;
            }
        });
        return true;
    } else {
        return false;
    }
}
</script>
</body>
</html>

