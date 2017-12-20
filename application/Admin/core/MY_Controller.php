<?php 
/**
 * 基类
 *
 * @author lidandan
 *
 * @version 2017-08-17
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('menu_model', 'menu');
        $this->load->model('user_model', 'user');
        //session类
        $this->load->library('session');
        //表单、URL辅助函数
        $this->load->helper(array('form','url','cookie'));
        //路径辅助函数
        $this->load->helper('path');

        // if (!$this->checkLogin()) {
        //     header('Location:'.site_url().'/login');
        //     exit;
        // }

        $request_url = $this->config->item('uri_protocol');
        $url = str_replace('/admin.php/', '', $_SERVER[$request_url]);
        $url = preg_replace('/\d(\/)?/is', '', $url);
        $data['menu_info'] = $this->menu->get_menu_url($url);
        $data['url'] = $url;


        //左侧菜单
        $param['parent_id'] = 0;
        $param['status'] = 0;
        $list = $this->menu->get_menu_list($param);
        $data['menu'] = $this->create_tree($list, $param);

        $this->load->view('public/header', $data);
    }

    /**
     * 检查是否登录
     * @return bool true/false
     */
    public function checkLogin()
    {
        $this->load->library('Public_library');
        $auth = get_cookie('ci_auth');
        $uid = $this->session->userdata('ci_uid');
        if ($uid) {
            $info = $this->user->get_user_info($uid);
            if ($info && $auth == $this->public_library($info['username'].$info['password'])) {
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * 递归菜单分类
     * @param array $list
     * @param number $lev
     * @return unknown
     */
    public function create_tree($list, $param)
    {
        $tree = array();
        if (!empty($list) && is_array($list)) {
            foreach ($list as $val) {
                $param['parent_id'] = $val['id'];
                $sub = $this->menu->get_menu_list($param);
                $val['sub'] = $this->create_tree($sub, $param);
                if (empty($val['sub'])) {
                    unset($val['sub']);
                }
                $tree[] = $val;
            }
        }
        return $tree;
    }
}

?>