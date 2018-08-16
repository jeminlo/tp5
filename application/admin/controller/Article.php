<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/16
 * Time: 16:59
 */

namespace app\admin\controller;


use app\common\controller\Base;
use app\common\model\Article as ArticleModel;
use think\Facade\Session;

class Article extends Base
{

    public function ArticleList()
    {
        $admin_id = Session::get('admin_id');
        $admin_level = Session::get('admin_level');
        if ($admin_level === '1'){
            $map = 1;
        } else {
            $map = [
                ['user_id' ,'=', $admin_id],
            ];

        }
        $articleList = ArticleModel::where($map)->paginate('10');

        $this->view->assign([
            'title' => '文章列表',
            'articleList' => $articleList,
        ]);
        return $this->view->fetch();
    }
}