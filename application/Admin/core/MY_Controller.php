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
        
        $this -> load -> model('menu_model', 'menu');
        
        //表单、URL辅助函数
        $this -> load -> helper(array('form','url'));
        //路径辅助函数
        $this -> load -> helper('path');
        
        $request_url = $this -> config -> item('uri_protocol');
        $url = str_replace('/admin.php/', '', $_SERVER['REQUEST_URI']);
        $data['menu_info'] = $this -> menu -> get_menu_url($url);
        $data['url'] = $url;
        //左侧菜单
        $param['parent_id'] = 0;
        $list = $this -> menu -> get_menu_list($param);
        $data['menu'] = $this -> create_tree($list);
        
        $this -> load -> view('public/header', $data);
    }
    
    /**
     * 递归菜单分类
     * @param array $list
     * @param number $lev
     * @return unknown
     */
    public function create_tree($list)
    {
        $tree = array();
        if( ! empty($list) && is_array($list))
        {
            foreach ($list as $val)
            {
                $param['parent_id'] = $val['id'];
                $sub = $this -> menu -> get_menu_list($param);
                $val['sub'] = $this -> create_tree($sub);
                if(empty($val['sub'])){
                    unset($val['sub']);
                }
                $tree[] = $val;
            }
        }
        return $tree;
    }
}

?>