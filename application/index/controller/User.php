<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/13
 * Time: 11:02
 */

namespace app\index\controller;

use app\common\controller\Base;
use app\common\model\User as UserModel;
use think\Facade\Request;
use think\facade\Session;

class User extends Base
{
    public function register()
    {
        $this->assign('title', '用户注册');
        return $this->fetch();
    }

    /**
     * 处理用户提交的注册数据
     */
    public function insert()
    {
        if (Request::isAjax()) {
            //使用模型创建数据
            $data = Request::param();
            $rule = '\app\common\validate\User';
            $is_validate = $this->validate($data, $rule);
            if (true !== $is_validate) {
                return ['status' => -1, 'message' => $is_validate];
            }
            $data = Request::except('password_confirm', 'post');
            $is_insert = UserModel::create($data);
            if ($is_insert) {
                $user_data = UserModel::get($is_insert->id);
                Session::set('user_id', $user_data->id);
                Session::set('user_name', $user_data->name);
                return ['status' => 1, 'message' => '注册成功'];
            } else {
                return ['status' => 0, 'message' => '注册失败'];
            }
        } else {
            $this->error('请求类型错误', 'register');
        }
    }

    //用户登录页面
    public function login()
    {
        $this->isLogin();
        $this->assign('title', 'Login');
        return $this->view->fetch('login', ['title', '用户登录']);
    }


    /**
     * 登录验证
     * @return array
     */
    public function loginCheck()
    {
        if (Request::isAjax()) {
            //使用模型创建数据
            $data = Request::param();
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
                return ['status' => 0, 'message' => '登录失败,请检查邮箱或密码'];
            } else {
                Session::set('user_id', $result->id);
                Session::set('user_name', $result->name);
                return ['status' => 1, 'message' => '登录成功'];
            }
        } else {
            $this->error('请求类型错误', 'login');
        }

    }

    public function logout()
    {
//        Session::delete('user_id');
//        Session::delete('user_name');
        Session::clear();
        $this->success('退出成功', 'index/index');
    }

}