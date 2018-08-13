<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/13
 * Time: 9:44
 */

namespace app\index\controller;


use app\common\controller\Base;

class Test extends Base
{
    public function index()
    {
        $data = [
            'name' => 'perterzhu',
            'email' => 'perter@php.com',
            'mobile' => '13712345678',
            'password' => '123abc',
            'password_confirm' => '123abc',
        ];
        $rule = '\app\common\validate\User';
        $result = $this->validate($data, $rule, [], true);
        dump($result);
    }

    public function test1()
    {
        return $res = \app\common\model\User::get(32);
//        $res->name = 'isme';
//        $res->save();
    }

}