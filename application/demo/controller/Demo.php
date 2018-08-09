<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/17
 * Time: 11:42
 */

namespace app\demo\controller;

use think\Controller;
use think\Container;

class Demo extends Controller
{
    public function index(\app\common\Temp $temp)
    {
        return $temp->getName();
//        return '';
    }

    public function bindClass()
    {
        Container::set('temp', '\app\common\Temp');

        $temp = Container::get('temp', ['name' => 'is you']);
        dump($temp->getName());
    }

    public function bindClosure()
    {
        Container::set('demoClosure',function(){
            return 'is 闭包';
        });
        return Container::get('demoClosure');

    }
}
