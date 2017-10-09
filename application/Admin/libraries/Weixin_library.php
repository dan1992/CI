<?php 
/**
 * 微信API
 * @author lidandan
 * @version 2017-08-22
 */
class Weixin_library
{
    public $app_id;
    public $app_secret;
    
    public function __construct($param)
    {
        $this->app_id     = $param['app_id'];
        $this->app_secret = $param['app_secret'];
    }
    
    /**
     * 获取access_token
     * @return mixed
     */
    public function get_access_token()
    {
        $url    = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->app_id.'&secret='.$this->app_secret;
        $result = $this->https_request($url);
        $result = json_decode($result, TRUE);
        return $result['access_token'];
    }
    
    /**
     * 创建自定义菜单
     * @param string $access_token
     * @param string $menu
     * @return mixed
     */
    public function create_weixin_menu($access_token, $menu)
    {
        $url    = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$access_token;
        $result = $this->https_request($url, $menu);
        $result = json_decode($result, TRUE);
        return $result;
    }
    
    /**
     * 获取自定义菜单
     * @param string $access_token
     * 
     */
    public function get_weixin_menu($access_token)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/get?access_token='.$access_token;
        $result = $this->https_request($url);
        $result = json_decode($result, TRUE);
        return $result;
    }
    
    /**
     * 获取用户基本信息
     * @param string $access_token
     * @param string $openid
     * @param string $lang
     * @return mixed
     */
    public function get_user_info($access_token, $openid, $lang = 'zh_CN')
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token.'&openid='.$openid.'&lang='.$lang;
        $result = $this->https_request($url);
        $result = json_decode($result, TRUE);
        return $result;
    }
    
    public function get_user_list($access_token, $next_openid)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/user/get?access_token='.$access_token.'&next_openid='.$next_openid;
        $result = $this->https_request($url);
        $result = json_decode($result, TRUE);
        return $result;
    }
    
    /**
     * 获取授权处理URL
     * @param string $url
     * @param string $scope          应用授权作用域
     *               snsapi_base     只能获取用户openid
     *               snsapi_userinfo 通过用户openid获取用户信息
     * @param string $state
     * @return string
     */
    public function get_oauth_code_url($url, $scope = 'snsapi_base', $state = '1')
    {
        $url     = urlencode($url);
        $codeurl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->app_id.'&redirect_uri='.$url.'&response_type=code&scope='.$scope.'&state='.$state.'#wechat_redirect';
        return $codeurl;
    }
    
    /**
     * 通过code换取网页授权access_token
     * @param string $code
     * @return Ambigous <multitype:, mixed>
     */
    public function get_oauth_access_token($code)
    {
        $url               = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$this->app_id.'&secret='.$this->app_secret.'&code='.$code.'&grant_type=authorization_code';
        $access_token_json = $this->https_request($url);
        $access_token_arr  = array();
        if (!empty($access_token_json)) {
            $access_token_arr = json_decode($access_token_json, TRUE);
        }
        return $access_token_arr;
    }
    
    /**
     * 通过网页授权获取用户信息
     * @param string $open_id        用户openid
     * @param string $access_token
     * @return Ambigous <multitype:, mixed>
     */
    public function get_oauth_user_info($open_id, $access_token)
    {
        $url          = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$open_id.'&lang=zh_CN';
        $user_info_json = $this->https_request($url);
        $user_info     = array();
        if (!empty($user_info_json)) {
            $user_info = json_decode($user_info_json, TRUE);
        }
        return $user_info;
    }
    
    /**
     * 获取jsapi_ticket
     * @param string $access_token
     * @return mixed
     */
    public function get_jsapi_ticket($access_token)
    {
        $url          = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$access_token.'&type=jsapi';
        $jsapi_ticket = $this->https_request($url);
        $jsapi_ticket = json_decode($jsapi_ticket, TRUE);
        return $jsapi_ticket;
    }
    
    /**
     * https请求（支持GET和POST）
     *
     * @param string $url
     * @param unknown_type $data
     */
    protected function https_request($url, $data = NULL)
    {
        //return file_get_contents($url);
    
         $curl = curl_init();
         curl_setopt($curl, CURLOPT_URL, $url);
         curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
         curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
         if (!empty($data)) {
             curl_setopt($curl, CURLOPT_POST, 1);
             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         }
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         $output = curl_exec($curl);
         curl_close($curl);
        return $output;
        /* $curl = curl_init();
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
         curl_setopt($curl, CURLOPT_TIMEOUT, 500);
         curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, TRUE);
         curl_setopt($curl, CURLOPT_URL, $url);
    
         $res = curl_exec($curl);
         curl_close($curl);
    
        return $res; */
    }
}
?>