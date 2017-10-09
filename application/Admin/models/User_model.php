<?php 
/**
 * Model层数据信息
 * 
 * @author lidandan
 * @version 2017-08-09
 */
class User_model extends CI_Model
{
    private $table = 'user';
    
    public function __construct()
    {
        parent::__construct();
        
        //手动链接数据库
        $this->load->database();
    }
    
    /**
     * 添加用户
     * @param array $data
     * @return boolean
     */
    public function insert($data)
    {
        if (empty($data)) {
            return false;
        }
        
        $res =  $this->db->insert($this->table, $data);
        if ($res) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    
    /**
     * 更新用户信息
     * @param number $id
     * @param array  $data
     * @return boolean
     */
    public function update($id, $data)
    {
        if (empty($id) OR empty($data)) {
            return false;
        }
        $where = 'id='.$id;
        return $this->db->update($this->table, $data, $where);
    }
    
    /**
     * 通过ID获取用户信息
     * @param number $id
     * @return boolean|unknown
     */
    public function get_user_by_id($id)
    {
        if (empty($id)) {
            return false;
        }
        $sql   = 'SELECT id,email,username,password,openid,weiboid FROM '.$this->table.' WHERE id='.$id;
        $query = $this->db->query($sql);
        $row   = $query->row();
        return $row;
    }
    
    /**
     * 根据用户名或邮箱获取用户信息
     * @param string $email
     * @param string $username
     * @return boolean
     */
    public function get_user_info($email, $username)
    {
        if (empty($email) && empty($username)) {
            return false;
        }
        
        $sql = 'SELECT id,email,username,password,openid,weiboid 
            FROM '.$this->table.' 
            WHERE email="'.$email.'"
            OR username="'.$username.'" 
            LIMIT 1';
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    /**
     * 检查用户是否存在
     * @param string $username
     * @param string $password
     * @return boolean
     */
    public function check_user_info($username, $password)
    {
        if (empty($username) OR empty($password)) {
            return false;
        }
        
        $sql = 'SELECT id FROM '.$this->table.' WHERE email="'.$username.'" OR username="'.$username.'" AND password="'.md5($password).'"';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return false;
        }
        
    }
}

?>