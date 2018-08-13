<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/13
 * Time: 9:25
 */

namespace app\common\model;

use think\Model;

class User extends Model
{
    protected $pk = 'id';
    protected $name = 'user';
    protected $autoWriteTimestamp = true;
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';

//    protected $updateFormat = 'Y-m-d H:i:s';

    //获取器
    /**
     * @param $value
     * @return mixed
     */
    public function getStatusAttr($value)
    {
        $status = ['1' => '启用', '0' => '禁用'];
        return $status["$value"];
    }

    public function getIsAdminAttr($value)
    {
        $status = ['1'=>'管理员', '0'=>'注册会员'];
        return $status["$value"];
    }

    //修改器

    /**
     * @param $val
     * @return string
     */
    public function setPasswordAttr($val)
    {
        return md5($val);
    }

}