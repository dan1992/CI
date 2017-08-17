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
        
        //表单、URL辅助函数
        $this -> load -> helper(array('form','url'));
        //路径辅助函数
        $this -> load -> helper('path');
    }
}

?>