<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        $this->view->assign('name','me');
        $this->view->fetch('index');
    }

}
