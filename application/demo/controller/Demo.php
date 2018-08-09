<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/17
 * Time: 11:42
 */

namespace app\demo\controller;

use think\Controller;

class Demo extends Controller
{
    public function index(\app\common\Temp $temp)
    {
        return $temp->getName();
//        return '';
    }
    public function BindClass(){
        \think\Container::set('temp','\app\common\Temp');

        $temp = \think\Container::get('temp',['name'=>'is you']);
        dump($temp->getName());
    }
}
