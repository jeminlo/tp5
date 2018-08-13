<?php
namespace app\index\controller;

use app\common\controller\Base;

class Index extends Base
{
    public function index()
    {
        $this->view->assign('name','me');
        return $this->view->fetch();
    }

}
