<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/9
 * Time: 14:06
 */

namespace app\facade;


use think\Facade;

class FacadeTest extends Facade
{
    protected static function getFacadeClass()
    {
       return '\app\common\FacadeTest';
    }
}