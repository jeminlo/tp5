<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/9
 * Time: 14:10
 */

namespace app\demo\controller;
use app\facade\FacadeTest;

class Demo1
{
    public function index()
    {
        return FacadeTest::hello(' is me');
    }
}