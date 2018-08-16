<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/15
 * Time: 16:11
 */

namespace app\admin\controller;


use app\common\controller\Base;

class Index extends Base
{
    public function index()
    {
        $this->isAdminLogout();
        return $this->view->fetch();
    }

}