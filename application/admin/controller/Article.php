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
use think\facade\Request;
use think\Facade\Session;

class Article extends Base
{

    /**
     * 文章列表页
     * @return string
     * @throws \think\exception\DbException
     */
    public function articleList()
    {
        $admin_id = Session::get('admin_id');
        $admin_level = Session::get('admin_level');
        if ($admin_level === '1') {
            $map = 1;
        } else {
            $map = [
                ['user_id', '=', $admin_id],
            ];

        }
        $articleList = ArticleModel::where($map)->paginate('10');

        $this->view->assign([
            'title' => '文章列表',
            'articleList' => $articleList,
        ]);
        return $this->view->fetch();
    }

    /**
     * 文章删除操作
     * @throws \Exception
     */
    public function delete()
    {
        $id = Request::param('id');
        $is_delete = ArticleModel::where('id', $id)->delete();
        if ($is_delete) {
            $this->success('成功删除', 'articleList');
        } else {
            $this->error('删除失败', 'articleList');
        }
    }

    /**
     * 文章修改页
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function edit()
    {
        $id = Request::param('id');
        $info = ArticleModel::find($id);
        $this->view->assign([
            'title' => '文章编辑',
            'info' => $info,
        ]);
        return $this->view->fetch();
    }

    public function doEdit()
    {
        //验证提交数据类型
        $data = Request::Post();
        $data['user_id'] = Session::get('user_id');
        $is_validate = $this->validate($data, 'app\common\validate\Article');
        if (true !== $is_validate) {
            //验证失败
            echo "<script>alert('$is_validate'); window.history.go(-1)</script>";
//            $this->error($is_validate, 'index/index/insert');
        } else {
            $file = Request::file('title_img');
            $info = $file->validate([
                'size' => '1000000',
                'ext' => 'jpeg,jpg,png,gif,bmp',
            ])->move('upload/');
            if ($info) {
                $data['title_img'] = $info->getSaveName();
            } else {
                return $this->error($file->getError);
            }
            if ($result = ArticleModel::update($data)) {
                $this->success('修改成功', url('articleList'));
            } else {
                $this->error('修改失败');
            }
        }
    }
}