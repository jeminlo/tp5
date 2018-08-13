<?php
/**
 *基础控制器
 */

namespace app\common\controller;

use think\Controller;
use think\Facade\Session;

class Base extends Controller
{

    /**
     * 初始化方法
     */
    protected function initialize()
    {
    }

    public function isLogin()
    {
        if (Session::has('user_id')){
            $this->error('你已经登录','index/index/index');
        }
    }
}