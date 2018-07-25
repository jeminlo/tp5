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
        return Db::query('select * from google_news ')->find();

    }
}