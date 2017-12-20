<?php
/**
 * 用户组管理
 * @Author: lidandan
 * @Date:   2017-12-21
 */
class Group extends CI_Model
{
    private $group = 'user_group';

    public function __construct()
    {
        parent::__construct();
        //手动连接数据库
        $this->load->database();
    }

    /**
     * 插入数据
     * @param  array $data 插入数据
     * @return number
     */
    public function insert($data)
    {
        if (empty($data)) {
            return false;
        }
        $data['addtime'] = data('Y-m-d H:i:s', time());
        $res = $this->db->insert($this->group, $data);
        if ($res) {
            return $this->db->insert_id($this->group);
        } else {
            return false;
        }
    }

    /**
     * 根据id更新数据
     * @param  number $id   用户组id
     * @param  array  $data 更新数据
     * @return bool true/false
     */
    public function update($id, $data)
    {
        if (empty($id) OR empty($data)) {
            return false;
        }
        $where = 'id='.$id;
        return $this->db->update($this->group, $data, $where);
    }

    /**
     * 根据id获取用户组信息
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function get_group_info($id)
    {
        if (empty($id)) {
            return false;
        }
        $this->db->where('id', id);
        $query = $this->db->get($this->group);
        return $query->row();
    }

    /**
     * 用户组列表
     * @param  array $param 查询条件
     * @param  number $start 开始数据
     * @param  number $limit 每页数量
     * @return array  用户组列表
     */
    public function get_group_list($param, $start, $limit)
    {
        if (isset($param['name'])) {
            $this->db->like('name', $param['name']);
        }
        $this->db->order_by('id','DESC');
        $query = $this->db->get($this->group, $limit, $start);
        return $query->result_array();
    }

    /**
     * 获取用户组数量
     * @param  array $param 查询条件
     * @return number 用户组数量
     */
    public function get_group_num($param)
    {
        if (isset($param['name'])) {
            $this->db->like('name', $param['name']);
        }
        $this->db->form($this->group);
        return $this->db->count_all_results();
    }
}