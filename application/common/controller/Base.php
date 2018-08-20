<?php
/**
 *基础控制器
 */

namespace app\common\controller;

use app\common\model\Article;
use app\common\model\ArticleCategory;
use app\common\model\Site;
use think\Controller;
use think\facade\Request;
use think\Facade\Session;

class Base extends Controller
{

    /**
     * 初始化方法
     */
    protected function initialize()
    {
        $this->showNav();
        $this->is_open();
        $this->getHot();
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
        $cateList = ArticleCategory::all(function ($query) {
            $query->where('status', 1)->order('sort', 'asc');
        });
        $this->view->assign('cateList', $cateList);
    }

    /**
     * 站点是否开启
     */
    public function is_open()
    {
        $is_open = Site::where(1)->value('is_open');
        if ($is_open == 0 && Request::module() != 'admin') {
            $info = "<body style='background: #333;text-align: center'><div style='color: white'>站点维护中...</div></body>";
            exit($info);
        }
    }

    /**
     * 是否关闭注册功能
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function is_reg()
    {
        $is_reg = Site::where(1)->find()->value('is_reg');
        if ($is_reg == 0) {
            $this->error('当前已不允许注册新用户');
        }
    }

    public function getHot()
    {
        $hotList = Article::order('is_hot', 'desc')->order('pv', 'desc')->limit(10)->select();
        $this->view->assign('hotList', $hotList);
    }
}