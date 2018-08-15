<?php

namespace app\index\controller;

use app\common\controller\Base;
use app\common\model\Article;
use app\common\model\ArticleCategory;
use app\common\model\UserFav;
use app\common\model\UserLike;
use think\facade\Request;
use think\facade\Session;
use think\db;

class Index extends Base
{
    //首页/文章列表
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
        $cateList = ArticleCategory::all(function ($query) {
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

    /**
     * 显示文章详情页
     */
    public function detail()
    {

        $id = Request::param('id');
        $art = Article::where('id', $id)->find();
        $art->setInc('pv');

        $fav_db = UserFav::where(['user_id' => Session::get('user_id'), 'article_id' => $id])->find();
        $is_fav = is_null($fav_db)? false : true;

        $like_db = UserLike::where(['user_id' => Session::get('user_id'), 'article_id' => $id])->find();
        $is_like = is_null($like_db)? false : true;

        $this->view->assign([
            'art' => $art,
            'is_fav' => $is_fav,
            'is_like' => $is_like,
            'title' => $art->title,
            'category_name' => $art->ArticleCategory->name,
        ]);
        return $this->view->fetch();
    }

    //文章收藏
    public function fav()
    {
        if (!Request::isAjax()) {
            return ['status' => -1, 'message' => '请求类型错误'];
        }
        //获取请求数据
        $data = Request::param();

        $user_id = Session::get('user_id');
        $article_id = $data['article_id'];
        //查询数据
        if (empty($user_id)) {
            return ['status' => -1, 'message' => '用户未登录'];
        }
        $map = [
            ['user_id', '=', $user_id],
            ['article_id', '=', $data['article_id']]
        ];
        $insert_data = [
            'user_id' => $user_id,
            'article_id' => $article_id,
        ];
        // 启动事务
        Db::startTrans();
        try {
            $result = UserFav::where($map)->find();
            if (is_null($result)) {
                $fva = new UserFav;
                $fva->save($insert_data);
                $msg = ['status' => 1, 'message' => '收藏成功'];
            } else {
                $result->delete();
                $msg = ['status' => 0, 'message' => '取消收藏'];
            }
            Db::commit();
        } catch (\Exception $e) {
            Db::rollback;
            $msg = ['status' => -1, 'message' => '操作失败'];
        }
        return $msg;
    }
    //文章点赞
    public function like()
    {
        if (!Request::isAjax()) {
            return ['status' => -1, 'message' => '请求类型错误'];
        }
        //获取请求数据
        $data = Request::param();

        $user_id = Session::get('user_id');
        $article_id = $data['article_id'];
        //查询数据
        if (empty($user_id)) {
            return ['status' => -1, 'message' => '用户未登录'];
        }
        $map = [
            ['user_id', '=', $user_id],
            ['article_id', '=', $data['article_id']]
        ];
        $insert_data = [
            'user_id' => $user_id,
            'article_id' => $article_id,
        ];
        // 启动事务
        Db::startTrans();
        try {
            $result = UserLike::where($map)->find();
            if (is_null($result)) {
                $like = new UserLike();
                $like->save($insert_data);
                $msg = ['status' => 1, 'message' => '点赞成功'];
            } else {
                $result->delete();
                $msg = ['status' => 0, 'message' => '取消点赞'];
            }
            Db::commit();
        } catch (\Exception $e) {
            Db::rollback;
            $msg = ['status' => -1, 'message' => '操作失败'];
        }
        return $msg;
    }

}
