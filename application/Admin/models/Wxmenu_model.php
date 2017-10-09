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
        
        $res = $this->db->insert($this->table, $data);
        if ($res) {
            return $this->db->insert_id();
        }
    }
}
?>