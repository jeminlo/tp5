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
use think\facade\Request;

class ArticleCategory extends Base
{
    /**
     * @return string
     * @throws \think\Exception\DbException
     * 分类列表页
     */
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


    /**
     * 添加分类操作
     */
    public function doAdd()
    {
        $data = Request::param();
        $is_insert = CategoryModel::create($data);
        if ($is_insert) {
            $this->success('添加成功', 'CategoryList');
        } else {
            $this->error('添加失败');
        }
    }

    /**
     * @return string
     * @throws \Exception
     * 添加分类页面
     */
    public function add()
    {
        return $this->view->fetch();
    }

    /**
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 分类编辑页
     */
    public function edit()
    {
        $cateId = Request::param('id');
        $cateInfo = CategoryModel::where('id', $cateId)->find();
        $this->view->assign([
            'title' => '编辑分类',
            'cateInfo' => $cateInfo,
        ]);
        return $this->fetch();
    }

    /**
     * 更新分类信息
     */
    public function update()
    {
        $data = Request::param();
        $id = $data['id'];
        unset($data['id']);
        $is_update = CategoryModel::where('id', $id)->update($data);
        if ($is_update) {
            return $this->success('更新成功', 'CategoryList');
        } else {
            $this->error('没有更新');
        }
    }

    /**
     * 更新分类信息
     */
    public function delete()
    {
        $data = Request::param();
        $id = $data['id'];
        $is_delete = CategoryModel::where('id', $id)->delete();
        if ($is_delete) {
            return $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }
}