<?php 
/**
 * 自定义菜单
 * 
 * @author lidandan
 *
 * @version 2017-08-22
 * 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Custommenu extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $param['app_id']     = '';
        $param['app_secret'] = '';
        
        $this->load->library('Weixin_library', $param);
        
        $this->load->model('Wxmenu_model', 'wxmenu');
    }
    
    public function index()
    {
        $message = '1、自定义菜单最多包括3个一级菜单，每个一级菜单最多包含5个二级菜单。<br>&nbsp;&nbsp;&nbsp;&nbsp;2、一级菜单最多4个汉字，二级菜单最多7个汉字，多出来的部分将会以“...”代替。';
        $menu = array();
        
        if ($_POST) {
            $list = array();
            $menu_1 = isset($_POST['menu_1']) ? $_POST['menu_1'] : '';
            $menu_2 = isset($_POST['menu_2']) ? $_POST['menu_2'] : '';
            $menu_3 = isset($_POST['menu_3']) ? $_POST['menu_3'] : '';
            
            for ($i = 1; $i <= 3; $i++) {
                $button = array();
                if (!empty($menu)) {
                    $button['name'] = $menu;
                    
                    $menu   = isset($_POST['menu'.$i]) ? addslashes($_POST['menu'.$i]) : '';
                    $type   = isset($_POST['type'.$i]) ? addslashes($_POST['type'.$i]) : '';
                    $keyurl = isset($_POST['keyurl'.$i]) ? addslashes($_POST['keyurl'.$i]) : '';
                    
                    $sub_menu   = isset($_POST['menu_'.$i]) ? $_POST['menu_'.$i] : '';
                    $sub_type   = isset($_POST['type_'.$i]) ? $_POST['type_'.$i] : '';
                    $sub_keyurl = isset($_POST['keyurl_'.$i]) ? $_POST['keyurl_'.$i] : ''; 
                    if(!empty($sub_menu) && is_array($sub_menu))
                    {
                        foreach ($sub_menu as $key => $sub) {
                            if (!empty($sub)) {
                                $sub_button = array();
                                $sub_button['name'] = addslashes(trim($sub));
                                $sub_button['type'] = addslashes(trim($sub_type[$key]));
                                if ($sub_type[$key] === 'click') {
                                    $sub_button['key'] = addslashes(trim($sub_keyurl[$key]));
                                } elseif ($sub_type[$key] === 'url') {
                                    $sub_button['url'] = addslashes(trim($sub_keyurl[$key]));
                                }
                                
                                $button['sub_botton'][] = $sub_button;
                            }
                        }
                    }
                
                    if (empty($button['sub_botton'])) {
                        $button['type'] = $type;
                        if ($type === 'click') {
                            $button['key'] = $keyurl;
                        } else {
                            $button['url'] = $keyurl;
                        }
                    }
                    $list[] = $button;
                }
            }
            
            if (!empty($list)) {
                $list = json_encode(array('button' => $list));
                
                //获取access_token
                $access_token = $this->weixin_library->get_access_token();
                
                $this->weixin_library->create_weixin_menu($access_token, $list);
                
                $data['name'] = $list;
                $this->wxmenu->add($data);
            }
            
            
        }
        
        $data['message'] = $message;
        
        $this->load->view('wxmenu/list', $data);
    }
}

?>