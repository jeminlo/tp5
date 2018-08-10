<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/9
 * Time: 15:37
 */

namespace app\demo\controller;

use app\demo\model\CircleOrderingLog;
use app\demo\model\GoogleNews;
use think\Db;


class Demo2
{
    public function index()
    {
        $res =CircleOrderingLog::where('id','>=',170000)->chunk(100,function ($users){
            foreach ($users as $user){
                echo  $user['modificator'].'<br/>';
            }
        });
//        dump($res);
    }
}