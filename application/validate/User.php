<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/10
 * Time: 11:55
 */

namespace app\validate;


use think\Validate;

class User extends Validate
{
    protected $rule = [
        'name' => [
            'require',
            'min' => 5,
            'max' => 20,
        ],
        'email' => [
            'require',
            'email' => 'email',
        ],
        'password' => [
            'require',
            'min' => 6,
            'max' => 12,
            'alphaNum',
        ],
        'mobile' => [
            'require',
            'mobile'
        ],
    ];

}