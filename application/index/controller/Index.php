<?php

namespace app\index\controller;

use app\common\controller\Base;
use app\common\model\Article;
use app\common\model\ArticleCategory;
use think\Db;
use think\facade\Request;
use think\facade\Session;
use think\Url;

class Index extends Base
{
    public function index()
    {
        $cate_id = Request::param('cate_id');
        if ($cate_id) {
            $result = ArticleCategory::get($cate_id);
            $title = $result->name;
        } else {
            $title = '全部文章';
        }
        $this->view->assign('title', $title);
        //文章列表分页显示
        $db_where[] = ['status', '=', 1];
        if ($cate_id) {
            $db_where[] = ['id', '=', $cate_id];
        }
        $search = Request::param('search');
        if (!empty($search)) {
            $db_where[] = ['title', 'like', "%$search%"];
        }
        $artList = Article::where($db_where)
                ->order('create_time', 'desc')->paginate(3);
        $this->view->assign('artList', $artList);
        $this->view->assign('empty', '<p>没有文章</p>');
        return $this->view->fetch();
    }

    //添加文章界面
    public function insert()
    {
        //1.检查是否已经登录
        $this->isLogout();
        //2.设置页面标题
        $this->view->assign('title', '发布文章');
        //获取栏目信息
        $cateList = ArticleCategory::all(function ($query){
            $query->where('status', 1)->order('sort', 'asc');
        });

        if (count($cateList) > 0) {
            //
            $this->assign('cateList', $cateList);
        } else {
            $this->error('请添加栏目', 'index/index');
        }
        //页面渲染
        return $this->fetch('insert');
    }

    //添加文章保存
    public function save()
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
            if (Article::create($data)) {
                $this->success('文章发布成功');
            } else {
                $this->error('文章发布失败');
            }
        }
    }

}
