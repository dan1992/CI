<?php 
/**
 * 菜单管理
 *
 * @author lidandan
 *
 * @version 2017-08-18
 *
 */
class Menu_model extends CI_Model
{
    private $table = 'menu';

    public function __construct()
    {
        parent::__construct();

        //连接数据库
        $this->load->database();
    }

    /**
     * 添加菜单
     * @param array $data
     * @return boolean
     */
    public function add_menu($data)
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
     * 更新菜单
     * @param number $id
     * @param array  $data
     * @return boolean
     */
    public function update_menu($id, $data)
    {
        if (empty($id) && empty($data)) {
            return false;
        }

        $where = 'id = '.$id;

        $res = $this->db->update($this->table, $data, $where);
        return $res;
    }

    /**
     * 获取菜单列表
     * @param array  $param
     * @param string $field
     * @param array  $order
     * @param number $start
     * @param number $limit
     */
    public function get_menu_list($param = array(), $field = '', $order = 'sort asc', $start = 0, $limit = 0)
    {
        $field = empty($field) ? 'id, name, url, icon, status, sort, description, parent_id' : $field;

        $this->db->where('is_del=', 0);

        if (isset($param['parent_id'])) {
            $this->db->where('parent_id=', $param['parent_id']);
        }
        if (isset($param['status'])) {
            $this->db->where('status=', $param['status']);
        }
        $this->db->order_by($order);

        $this->db->limit($limit, $start);

        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    /**
     * 获取菜单信息
     * @param number $id
     * @param string $field
     * @return boolean
     */
    public function get_menu_info($id, $field = '')
    {
        if (empty($id)) {
            return false;
        }
        $field = empty($field) ? 'id, name, url, icon, status, sort, description, parent_id' : $field;

        $sql = 'SELECT '.$field.' FROM '.$this->table.' WHERE id = '.$id;

        $query = $this->db->query($sql);

        return $query->row_array();
    }

    /**
     * 根据链接获取菜单信息
     * @param string $url
     * @param string $field
     * @return boolean
     */
    public function get_menu_url($url, $field = '')
    {
        if (empty($url)) {
            return false;
        }

        $field = empty($field) ? 'id, name, status, parent_id' : $field;

        $sql = 'SELECT '.$field.' FROM '.$this->table.' WHERE url = "'.$url.'"';

        $query = $this->db->query($sql);

        return $query->row_array();
    }

    /**
     * 菜单数量
     * @return
     */
    public function get_menu_num()
    {
        return $this->db->count_all($this->table);
    }
}

?>