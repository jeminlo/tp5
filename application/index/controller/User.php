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
            if(true !== $is_validate){
                return ['status'=> -1, 'message'=>$is_validate];
            }
            $data = Request::except('password_confirm', 'post');
            $is_insert = UserModel::create($data);
            if ($is_insert) {
                return ['status' => 1, 'message' => '注册成功'];
            } else {
                return ['status' => 0, 'message' => '注册失败'];
            }
        } else {
            $this->error('请求类型错误', 'register');
        }
    }

}