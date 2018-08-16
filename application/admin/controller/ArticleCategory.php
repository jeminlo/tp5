<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/16
 * Time: 14:45
 */

namespace app\admin\controller;


use app\common\controller\Base;
use app\common\model\ArticleCategory as CategoryModel;

class ArticleCategory extends Base
{
    public function CategoryList()
    {
        $this->isAdminLogout();
        $cateList = CategoryModel::all();
        $this->view->assign([
            'title' => '分类管理',
            'empty' => '<span>没有分类</span>',
            'cateList' => $cateList
        ]);
        return $this->view->fetch();
    }
}