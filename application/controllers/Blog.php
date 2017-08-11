<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 测试
 * @author lidandan
 * @version 2017-08-07
 * 
 */
class Blog extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        echo 'Hello World';
    }
    
    public function blog()
    {
        //echo '<pre>';
        //print_r($this);
        $this -> load -> library('Blog_library');
        
        $test = $this -> blog_library -> test();
        
        print_r($test);
        
        $this -> load -> view('login');
    }
}
?>