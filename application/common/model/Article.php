<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/13
 * Time: 17:12
 */

namespace app\common\model;

use think\Model;

class Article extends Model
{
    protected $autoWriteTimestamp = true;

    //开启自动设置
    protected $auto = [];
    //仅新增时有效
    protected $insert = ['create_time', 'status' => 1, 'is_top' => 0, 'is_hot' => 0];
    //仅更新时设置
    protected $update = ['update_time'];

    //绑定用户信息表
    public function user()
    {
        return $this->belongsTo('User');
    }

    //绑定文章分类表
    public function articleCategory()
    {
        return $this->belongsTo('ArticleCategory', 'cate_id');
    }

}