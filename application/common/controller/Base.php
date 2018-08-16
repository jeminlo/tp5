<?php
/**
 *基础控制器
 */

namespace app\common\controller;

use app\common\model\ArticleCategory;
use think\Controller;
use think\Facade\Session;

class Base extends Controller
{

    /**
     * 初始化方法
     */
    protected function initialize()
    {
        $this->showNav();
    }

    /**
     * 是否登录
     */
    public function isLogin()
    {
        if (Session::has('user_id')) {
            $this->error('你已经登录', 'index/index/index');
        }
    }

    /**
     * 前台是否未登录
     */
    public function isLogout()
    {
        if (!Session::has('user_id')) {
            $this->error('你尚未登陆', 'user/login');
        }
    }
    /**
     * 后台是否未登录
     */
    public function isAdminLogout()
    {
        if (!Session::has('admin_id')) {
            $this->error('你尚未登陆', 'admin/user/login');
        }
    }

    /**
     * 显示导航
     */
    protected function showNav()
    {
        $cateList = ArticleCategory::all(function ($query){
           $query->where('status', 1)->order('sort', 'asc');
        });
        $this->view->assign('cateList', $cateList);
    }

}