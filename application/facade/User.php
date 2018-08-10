<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/10
 * Time: 13:53
 */

namespace app\facade;


use think\Facade;

class User extends Facade
{
    protected static function getFacadeClass()
    {
        return 'app\validate\User';
    }
}