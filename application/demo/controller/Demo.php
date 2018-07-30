<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/17
 * Time: 11:42
 */

namespace app\demo\controller;

use think\Controller;
use think\Db;

class Demo extends controller
{
    public function index(){
        $data = [
            ['title'=>rand(1,9999),'href'=>'text',1=>0],
            ['title'=>rand(1,9999),'href'=>'text',1=>0]
        ];
        $res = Db::name('google_news')->strict(false)->limit(100)->insertAll($data);
        dump($res);
    }


}