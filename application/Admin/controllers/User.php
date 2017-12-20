<?php 
/**
 * 后台用户管理
 * @author lidandan
 * 
 * @version 2017-08-22
 */
class User extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model', 'user');
    }
    public function lists()
    {
        $param['email'] = isset($_POST['email']) ? addslashes(trim($_POST['email'])) : '';
        $param['username'] = isset($_POST['username']) ? addslashes(trim($_POST['username'])) : '';
        $perpage = 10;
        $start = ($page-1)*$perpage;
        $list = $this->user->get_user_list($param, $start, $perpage);
        $data['list'] = $list;
        $this->load->view('user/list');
    }

    public function detail($uid='')
    {
    }
}
?>