<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/15
 * Time: 17:00
 */

namespace app\admin\controller;


use app\common\controller\Base;
use think\facade\Request;
use app\common\model\User as UserModel;
use think\facade\Session;

class User extends Base
{
    public function login()
    {
        $this->view->assign('title', '管理员登录');
        return $this->view->fetch();
    }

    /**
     * 登录验证
     * @return array
     */
    public function loginCheck()
    {
        if (Request::isPost()) {
            $data = Request::param();
            //使用模型创建数据
            $rule = [
                'email|邮箱' => 'require|email',
                'password|密码' => 'require|alphaNum',
            ];
            $is_validate = $this->validate($data, $rule);
            if (true !== $is_validate) {
                return ['status' => -1, 'message' => $is_validate];
            }
            $result = UserModel::get(function ($query) use ($data) {
                $query->where('email', $data['email'])
                    ->where('password', md5($data['password']));
            });
            if (null === $result) {
                $this->error('登录失败');
            } else {
                Session::set('admin_id', $result->id);
                Session::set('admin_name', $result->name);
                Session::set('admin_level', $result->is_admin);
                $this->success('登录成功', 'admin/index/index');
            }
        } else {
            $this->error('请求类型错误');
        }

    }

    /**
     * 退出登录
     */
    public function logout()
    {
        Session::clear();
        $this->success('退出成功', 'admin/user/login');
    }


    /**
     * 用户列表
     */
    public function userList()
    {
        $data['admin_id'] = Session::get('admin_id');
        $data['admin_level'] = Session::get('admin_level');

        //获取当前用户信息

        if ($data['admin_level'] !== '管理员') {
            $userList = UserModel::where('id', $data['admin_id'])->select();
        } else {
            $userList = UserModel::all();
        }
        //模板赋值
        $this->view->assign([
            'title' => '用户管理',
            'empty' => '<span class="text-default">没有数据</span>',
            'userList' => $userList,
        ]);
        return $this->view->fetch();
    }
}