<?php
/**
 * 权限认证类
 * @Author: lidandan
 * @Date:   2017-12-22 16:55:41
 */
class Auth_library
{
    public function checkAuth($url, $uid)
    {
        static $power;
    }

    public function get_user_info($uid)
    {
        $this->load->model('User_model','user');
        $this->user->get_user_info($uid);
    }
}