<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/17
 * Time: 11:42
 */

namespace app\demo\controller;

use app\demo\model\CircleOrderingLog;
use app\demo\model\GoogleNews;
use think\Controller;


class Demo extends controller
{
    public function index()
    {
        $res = CircleOrderingLog::where('id','>',60000)->buildSql();
//        $res->content = ['status'=>1,'time'=>time()] ;
//        echo $res->content->status;
//        $res->save();
        dump($res);
    }
}
