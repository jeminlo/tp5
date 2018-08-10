<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/17
 * Time: 11:42
 */

namespace app\demo\controller;

use think\Controller;
use app\facade\User AS ValidateUser;

class Demo extends controller
{
    // 是否批量验证

    public function index()
    {
        $data = [
//            'name' => 'Peter',
//            'email' => 'peter@php.cn',
            'password' => '123adc',
            'mobile' => '13745678912',
        ];
        if (!ValidateUser::check($data)) {
            return ValidateUser::getError();
        } else {
            return '验证通过';
        }
//        $result = $this->validate($data, '\app\validate\User');
//        if (true !== $result){
//            dump($result);
//        }
    }
}
