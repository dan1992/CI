<?php
/**
 * 登录
 * @author lidandan
 *
 * @version 2017-08-09
 *
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    /**
     * 构造函数必须要写
     */
    public function __construct()
    {
        parent::__construct();
        //URL辅助函数
        $this->load->helper(array('form','url'));

        //加载model
        $this->load->model('user_model', 'user');

        //加载表单验证类
        $this->load->library('form_validation');

        //错误信息的设置
        $this->form_validation->set_message('required', "{field}不能为空");
        $this->form_validation->set_message('valid_email', "请输入正确的{field}");
        $this->form_validation->set_message('matches', '请确保两次密码一致');
        $this->form_validation->set_message('min_length','{field}至少为六位');
        $this->form_validation->set_message('max_length', '{field}最多为16位');
    }

    /**
     * 登录页面
     */
    public function index()
    {
        $base_url = $this->config->item('base_url');
        $data['base_url'] = $base_url;
        $data['message']  = '';
        if (isset($_POST['login']) && !empty($_POST['login'])) {
            $username = isset($_POST['username']) ? addslashes($_POST['username']) : '';
            $password = isset($_POST['password']) ? addslashes($_POST['password']) : '';
            $yzmCode  = isset($_POST['yzm']) ? addslashes($_POST['yzm']) : '' ;

            //表单验证
            $this->form_validation->set_rules('username', '用户名', 'trim|required');
            $this->form_validation->set_rules('password', '密码', 'trim|required|min_length[6]|max_length[16]');
            $this->form_validation->set_rules('yzm', '验证码', 'trim|required');

            if ($yzmCode != $_COOKIE['CIYzmCode']) {
                $data['message'] = '验证码错误';
            }

            $user_info = $this->user->get_user_info($username, $password);
            if ($user_info) {
                $this->load->library('session');
                $this->session->set_userdata('ci_uid', $user_info['id']);
                $this->load->helper('cookie');
                $this->load->library('Public_library');
                $auth = $this->public_library->password($user_info['username'].$user_info['password']);
                set_cookie('ci_auth', $auth);

                $data['message'] = '登录成功';
                header('Location:'.site_url());
                exit;
            } else {
                $data['message'] = '登录失败';
            }
        }

        $this->load->view('login', $data);
    }

    /**
     * 验证码（第一种）
     */
    public function verify()
    {
        //生成验证码图片
        header("Content-type: image/png");
        // 全数字
        $str = "1,2,3,4,5,6,7,8,9,a,b,c,d,e,f,g,h,i,j,k";      //要显示的字符，可自己进行增删
        $list = explode(",", $str);
        $cmax = count($list) - 1;
        $verifyCode = '';
        for ( $i=0; $i < 5; $i++ ) {
            $randnum = mt_rand(0, $cmax);
            $verifyCode .= $list[$randnum];           //取出字符，组合成为我们要的验证码字符
        }

        $image = imagecreate(81,30);    //生成图片

        $whiteColor = imagecolorallocate($image, 255, 255, 255);//白色背景
        $blackColor = imagecolorallocate($image,   0,   0,   0);//黑色字
        $count = 81 * 30 / 8;

        for ($i = 0; $i < $count; $i++) {
            $randomColor = imagecolorallocate($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
            imagesetpixel($image, mt_rand(0, 81), mt_rand(0, 30), $randomColor);
        }

        //将验证码绘入图片
        imagestring($image, 5, 15, 8, $verifyCode, $blackColor);    //将验证码写入到图片中

        setCookie("CIYzmCode",$verifyCode,time()+200);        //将字符放入COOKIE中

        imagepng($image);
        imagedestroy($image);
    }

    /**
     * 根据验证码辅助函数（第二种）
     */
    public function regverify()
    {
        //验证码辅助函数
        $this->load->helper('captcha');
        $ver = array(
            'img_path'    => './application/Admin/views/static/captcha/',
            'img_url'     => base_url().'application/Admin/views/static/captcha/',
            'word_length' => 5,
            'img_width'   => '81',
            'img_height'  => '30',
            'font_size'   => 16,
        );

        $images = create_captcha($ver);
        if ($images['word']) {
            //COOKIE辅助函数
            $this->load->helper('cookie');
            set_cookie('CIRegYzmCode', $images['word'], time()+200);
        }

        echo json_encode(array('status' => 1, 'verify' => $images));
        exit;
    }

    /**
     * 注册
     */
    public function register()
    {
        $email    = isset($_POST['regemail']) ? addslashes($_POST['regemail']) : '';
        $username = isset($_POST['regusername']) ? addslashes($_POST['regusername']) : '';
        $password = isset($_POST['regpassword']) ? addslashes($_POST['regpassword']) : '';
        $regpw    = isset($_POST['regreppw']) ? addslashes($_POST['regreppw']) : '';
        $yzmcode  = isset($_POST['captcha']) ? addslashes($_POST['captcha']) : '';

        //表单验证
        $this->form_validation->set_rules('regemail', '邮箱', 'trim|required|valid_email');
        $this->form_validation->set_rules('regusername', '用户名', 'trim|required');
        $this->form_validation->set_rules('regpassword', '密码', 'trim|required|min_length[6]|max_length[16]');
        $this->form_validation->set_rules('regreppw', '重新输入', 'trim|required|matches[regpassword]');
        $this->form_validation->set_rules('captcha', '验证码', 'trim|required');
        //设置错误信息定界符<p>xxxx</p>
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run()) { //验证成功

            if ($yzmcode != $_COOKIE['CIRegYzmCode']) {
                echo json_encode(array('status' => 0, 'info' => '验证码错误'));
                exit;
            }

            $info = $this->user->check_user_info($email, $username);
            if (!empty($info)) {
                echo json_encode(array('status' => 0, 'info' => '用户名或邮箱已注册'));
                exit;
            }

            $data = array(
                'email'    => $email,
                'username' => $username,
                'password' => md5($password),
                'addtime'  => date('Y-m-d H:i:s', time())
            );
            $res = $this->user->insert($data);
            if ($res) {
                echo json_encode(array('status' => 1, 'info' => '注册成功', 'res' => $res));
                exit;
            } else {
                echo json_encode(array('status' => 0, 'info' => '注册失败'));
                exit;
            }
        } else {
            echo json_encode(array('status' => 0, 'info' => validation_errors()));
            exit;
        }
    }
    /**
     * 修改密码
     */
    public function retrievepw()
    {

    }
}
?>