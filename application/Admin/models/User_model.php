<?php
/**
 * Model层数据信息
 *
 * @author lidandan
 * @version 2017-08-09
 */
class User_model extends CI_Model
{
    private $user = 'user_info';
    private $group = 'user_group';

    public function __construct()
    {
        parent::__construct();

        //手动链接数据库
        $this->load->database();
    }

    /**
     * 添加用户
     * @param array $data 添加数据
     * @return boolean
     */
    public function insert($data)
    {
        if (empty($data)) {
            return false;
        }

        $res =  $this->db->insert($this->user, $data);
        if ($res) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    /**
     * 更新用户信息
     * @param number $id   用户id
     * @param array  $data 更新数据
     * @return boolean
     */
    public function update($id, $data)
    {
        if (empty($id) OR empty($data)) {
            return false;
        }
        $where = 'id='.$id;
        return $this->db->update($this->user, $data, $where);
    }

    /**
     * 通过ID获取用户信息
     * @param number $id       用户id
     * @return boolean|unknown
     */
    public function get_user_by_id($id)
    {
        if (empty($id)) {
            return false;
        }
        $sql   = 'SELECT id,email,username,password,openid,weiboid,groupid FROM '.$this->user.' WHERE id='.$id;
        $query = $this->db->query($sql);
        return $query->row();
    }

    /**
     * 根据用户名获取用户信息
     * @param string $username 用户名
     * @param string $password 密码
     * @return boolean
     */
    public function get_user_info($username, $password)
    {
        if (empty($password) && empty($username)) {
            return false;
        }

        $sql = 'SELECT u.id,email,username,password,openid,weiboid,groupid,power FROM '.$this->user.
               ' as u WHERE email="'.$username.
               '" OR username="'.$username.
               '" ADN password = "'.md5($password).
               '" JOIN '.$this->group.' as g ON u.groupid = g.id LIMIT 1';
        $query = $this->db->query($sql);
        return $query->row();
    }

    /**
     * 检查用户是否存在
     * @param string $username 用户名
     * @param string $password 密码
     * @return boolean
     */
    public function check_user_info($username, $email)
    {
        if (empty($username) OR empty($email)) {
            return false;
        }

        $sql = 'SELECT id FROM '.$this->user.' WHERE email="'.$email.'" OR username="'.$username.'"';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 用户列表
     * @param  array  $param 查询条件
     * @param  number $start 开始
     * @param  number $limit 每页数量
     * @return array  列表
     */
    public function get_user_list($param, $start, $limit)
    {
        if (!empty($param['username'])) {
            $this->db->like('username', $param['username']);
        }

        if (!empty($param['email'])) {
            $this->db->like('email', $param['email']);
        }
        $this->db->order_by('id','DESC');
        $query = $this->db->get($this->user, $limit, $start);
        return $query->result_array();
    }

    /**
     * 获取用户数量
     * @param  array $param 查询条件
     * @return number 用户数量
     */
    public function get_user_num($param)
    {
        if (!empty($param['username'])) {
            $this->db->like('username', $param['username']);
        }
        if (!empty($param['email'])) {
            $this->db->like('email', $param['email']);
        }
        return $this->db->count_all_results();
    }
}

?>