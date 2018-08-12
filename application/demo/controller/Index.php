<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/12
 * Time: 12:33
 */

namespace app\demo\controller;


use think\Controller;

class Index extends Controller
{
    public function Index()
    {
        return $this->fetch('index',['name'=>'me']);
    }

}