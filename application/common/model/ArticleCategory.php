<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/13
 * Time: 17:21
 */

namespace app\common\model;


use think\Model;

class ArticleCategory extends Model
{
    protected $autoWriteTimestamp = true;

    //开启自动设置
    protected $auto = [];
    //仅新增时有效
    protected $insert = ['create_time', 'status' => 1];
    //仅更新时设置
    protected $update = ['update_time'];

    protected function getStatusAttr($value)
    {
        $status = [
            '0' => '禁用',
            '1' => '启用',
        ];
        return $status["$value"];
    }
}