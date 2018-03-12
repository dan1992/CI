<?php 
/**
 * 后台管理首页
 * @author lidandan
 * 
 * @version 2017-08-17
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('index');
    }
}
?>