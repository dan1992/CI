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
        $param['n ame'] = isset($_POST['name']) ? addslashes(trim($_POST['name'])) : '';
        $perpage = 10;
        $start = ($page - 1)*$perpage;
        $list = $this->group->get_group_list($param, $start, $perpage);
        $data['list'] = $list;

        //分页类
        $this->load->library('pagination');
        $pagination['base_url'] = site_url('group/lists');
        $pagination['total_rows'] = $this->group->get_group_num($param);
        $pagination['per_page'] = $perpage;

        $this->pagination->initialize($pagination);

        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('group/list', $data);
    }

    /**
     * 添加/更新
     * @param  string $gid 用户组id
     * @return
     */
    public function detail($gid = '')
    {
        if (!empty($gid)) {
            $info = $this->group->get_group_info($gid);
            $data['info'] = $info;
        }
        $message = '';
        $info['name'] = isset($_POST['group_name']) ? trim($_POST['group_name']) : '';
        $info['status'] = isset($_POST['status']) ? (int)$_POST['status'] : 0;
        $info['description'] = isset($_POST['desc']) ? trim($_POST['desc']) : '';

        if ($_POST) {
            if (empty($info['name'])) {
                $message = '用户组名称不能为空';
            }
            if ($gid) {
                $res = $this->group->update_group($gid, $info);
                if ($res) {
                    $message = '更新成功';
                } else {
                    $message = '更新失败';
                }
            } else {
                $gid = $this->group->add_group($info);
                if ($gid) {
                    $message = '添加成功';
                } else {
                    $message = '添加失败';
                }
            }
        }
        $data['message'] = $message;
        $data['gid'] = $gid;

        $this->load->view('group/detail', $data);
    }

    /**
     * 权限
     * @param  string $gid 用户组id
     * @return
     */
    public function power($gid = '')
    {
        $group_info = $this->group->get_group_info($gid);
        $data['info'] = $group_info;
        $param['parent_id'] = 0;
        $list = $this->menu->get_menu_list($param);
        $data['list']  = $this->create_tree($list, $param);

        $this->load->view('group/power', $data);
    }

    /**
     * 删除
     * @return [type] [description]
     */
    public function del($gid = '')
    {
        if (empty($gid)) {
            echo json_encode(['status' => 1, 'info' => '参数错误']);
            exit;
        }
        $info['is_del'] = 1;
        $res = $this->group->update_group($gid, $info);
        if ($res) {
            echo json_encode(['status' => 0, 'info' => '删除成功']);
            exit;
        } else {
            echo json_encode(['status' => 1, 'info' => '删除失败']);
            exit;
        }
    }
}