<?php 
/**
 * 菜单管理
 * 
 * @author lidandan
 * 
 * @version 2017-08-18
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * 列表页
     */
    public function lists()
    {
        $param['parent_id'] = 0;
        $list = $this -> menu -> get_menu_list($param);
        $data['list'] = $this -> create_tree($list);
        
        $this -> load -> view('menu/list', $data);
    }
    
    /**
     * 添加/更新
     */
    public function detail($menu_id = '')
    {
        $message = '';
        
        if( ! empty($menu_id))
        {
            $info = $this -> menu -> get_menu_info($menu_id);
            $data['info']    = $info;
        }
        
        $info = array();
        $info['name'] = isset($_POST['menu_name']) ? addslashes(trim($_POST['menu_name'])) : '';
        $info['url']  = isset($_POST['menu_url']) ? addslashes(trim($_POST['menu_url'])) : '';
        $info['icon'] = isset($_POST['icon']) ? addslashes(trim($_POST['icon'])) : '';
        $info['status'] = isset($_POST['status']) ? (int)$_POST['status'] : '';
        $info['sort']   = isset($_POST['paixu']) ? (int)$_POST['paixu'] : 99;
        $info['parent_id']   = isset($_POST['parent']) ? (int)$_POST['parent'] : 0;
        $info['description'] = isset($_POST['desc']) ? addslashes(trim($_POST['desc'])) : '';
        
        if( ! empty($_POST))
        {
            
            if(empty($info['name']))
            {
                $message = '菜单名称不能为空';
            }
            
            if(empty($info['url']))
            {
                $message = '链接不能为空';
            }
            
            if(empty($menu_id))
            {
                $info['addtime'] = date('Y-m-d H:i:s', time());
                $info['adduser'] = 'xx';
                $res = $this -> menu -> add_menu($info);
                if($res)
                {
                    $message = '添加成功';
                }
                else
                {
                    $message = '添加失败';
                }
            }
            else
            {
                $res = $this -> menu -> update_menu($menu_id, $info);
                if($res)
                {
                    $message = '更新成功';
                }
                else 
                {
                    $message = '更新失败';
                }
            }
            
            $data['info'] = $info;
        }
        
        $param['parent_id'] = 0;
        $list = $this -> menu -> get_menu_list($param);
        $data['list']  = $this -> create_tree($list);
        
        $data['message'] = $message;
        $data['menu_id'] = $menu_id;
        
        $this -> load -> view('menu/info', $data);
    }
    
    /**
     * 删除
     */
    public function del($menu_id)
    {
        if(empty($menu_id))
        {
            echo json_encode(array('status' => 0, 'info' => '参数错误'));
            exit;
        }
        
        $info['is_del'] = 1;
        $res = $this -> menu -> update_menu($menu_id, $info);
        if($res)
        {
            echo json_encode(array('status' => 1, 'info' => '删除成功'));
            exit;
        }
        else 
        {
            echo json_encode(array('status' => 0, 'info' => '删除失败'));
            exit;
        }
    }
}

?>