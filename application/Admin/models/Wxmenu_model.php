<?php 
class Wxmenu_model extends CI_Model
{
    private $table = 'weixin_menu';
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function add($data)
    {
        if (empty($data)) {
            return false;
        }
        $data['addtime'] = date('Y-m-d H:i:s',time());
        $res = $this->db->insert($this->table, $data);
        if ($res) {
            return $this->db->insert_id();
        }
        return false;
    }
}
?>