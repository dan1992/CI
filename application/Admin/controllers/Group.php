<?php
/**
 * 用户组管理
 * @Author: lidandan
 * @Date:   2017-12-21 14:42:42
 */
class Group extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('group_model', 'group');
    }

    /**
     * 用户组列表
     * @param  integer $page 页数
     * @return
     */
    public function lists($page = 1)
    {
        $param['name'] = isset($_POST['name']) ? addslashes(trim($_POST['name'])) : '';
        $perpage = 10;
        $start = ($page - 1)*$perpage;
        $list = $this->group->get_group_list($param, $start, $perpage);
        $data['list'] = $list;

        //分页类
        $this->load->library('pagination');
        $pagination['base_url'] = 'http://example.com/index.php/test/page/';
        $pagination['total_rows'] = 200;
        $pagination['per_page'] = 20;

        $this->pagination->initialize($pagination);

        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('group/list', $data);
    }

    public function detail($gid = '')
    {
        if (!empty($gid)) {
            $info = $this->group->get_group_info($gid);
            $data['info'] = $info;
        }

        if ($_POST) {
            
        }
    }
}
