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
                Session::set('admin_level', $result->getData('is_admin'));
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

        if ($data['admin_level'] === 1) {
            $map = 1;
        } else {
            $map = ['id' => $data['admin_id']];
        }
        $userList = UserModel::where($map)->paginate(10);
        //模板赋值
        $this->view->assign([
            'title' => '用户管理',
            'empty' => '<span class="text-default">没有数据</span>',
            'userList' => $userList,
        ]);
        return $this->view->fetch();
    }

    /**
     * 用户资料修改页面
     */
    public function userEdit()
    {
        $userId = Request::param('id');
        $userInfo = UserModel::where('id', $userId)->find();
        $this->view->assign([
            'title' => '编辑用户',
            'userInfo' => $userInfo,
        ]);
        return $this->view->fetch();
    }

    /**
     * 存储用户修改资料
     */
    public function userUpdate()
    {
        $data = Request::param();
        $id = $data['id'];
        unset($data['id']);
        $is_update = UserModel::where('id', $id)->data($data)->update();
        if ($is_update) {
            return $this->success('更新成功', 'userList');
        } else {
            return $this->error('没有更新');
        }
    }

    /**
     * 删除用户
     */
    public function userDelete()
    {
        $userId = Request::param('id');
        $is_delete = UserModel::where('id', $userId)->delete();
        if ($is_delete) {
            return $this->success('删除成功');
        } else {
            return $this->error('删除失败');
        }

    }
}