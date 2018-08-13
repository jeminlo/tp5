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
}