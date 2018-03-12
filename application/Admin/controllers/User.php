<?php
/**
 * 后台用户管理
 * @author lidandan
 *
 * @version 2017-08-22
 */
class User extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('group_model', 'group');
    }

    /**
     * 用户列表
     * @param  integer $page 页数
     * @return
     */
    public function lists($page = 1)
    {
        $param['email'] = isset($_POST['email']) ? addslashes(trim($_POST['email'])) : '';
        $param['username'] = isset($_POST['username']) ? addslashes(trim($_POST['username'])) : '';
        $perpage = 10;
        $start = ($page-1)*$perpage;
        $list = $this->user->get_user_list($param, $start, $perpage);
        $data['list'] = $list;

        //分页类
        $this->load->library('pagination');
        $pagination['base_url'] = site_url('user/lists');
        $pagination['total_rows'] = $this->user->get_user_num($param);
        $pagination['per_page'] = $perpage;

        $this->pagination->initialize($pagination);

        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('user/list', $data);
    }

    /**
     * 添加/更新
     * @param  string $uid 用户id
     * @return
     */
    public function detail($uid = '')
    {
        if (!empty($uid)) {
            $info = $this->user->get_user_by_id($uid);
            $data['info'] = $info;
        }
        $message = '';
        $info['username'] = isset($_POST['username']) ? trim($_POST['username']) : '';
        $info['email'] = isset($_POST['email']) ? trim($_POST['email']) : '';
        $info['realname'] = isset($_POST['realname']) ? trim($_POST['realname']) : '';
        $info['password'] = isset($_POST['password']) ? trim($_POST['password']) : '';
        $info['phone'] = isset($_POST['phone']) ? trim($_POST['phone']) : '';
        $info['groupid'] = isset($_POST['groupid']) ? (int)$_POST['groupid'] : 0;

        if ($_POST) {
            if (empty($info['username'])) {
                $message = '用户名不能为空';
            }
            if (empty($info['password'])) {
                $message = '密码不能为空';
            }
            if ($uid) {
                $res = $this->user->update_user($uid, $info);
                if ($res) {
                    $message = '更新成功';
                } else {
                    $message = '更新失败';
                }
            } else {
                $res = $this->user->add_user($info);
                if ($res) {
                    $message = '添加成功';
                } else {
                    $message = '添加失败';
                }
            }
        }
        $data['group'] = $this->group->get_group_list();
        $data['uid'] = $uid;
        $data['message'] = $message;

        $this->load->view('user/detail', $data);
    }

    /**
     * 个人信息
     * @return
     */
    public function info()
    {
        $data['info'] = $this->user_info;
        $this->load->view('user/info', $data);
    }

    /**
     * 删除用户
     * @param  string $uid 用户id
     * @return
     */
    public function del($uid = '')
    {
        if (empty($uid)) {
            echo json_encode(['status' => 1, 'info' => '参数错误']);
            exit;
        }

        $info['is_del'] = 1;
        $res = $this->user->update_user($uid, $info);
        if ($res) {
            echo json_encode(['status' => 0, 'info' => '删除成功']);
            exit;
        } else {
            echo json_encode(['status' => 1, 'info' => '删除失败']);
        }
    }
}
?>