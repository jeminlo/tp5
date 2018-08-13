<?php
/**
 * user表验证器
 */

namespace app\common\validate;


use think\Validate;

class User extends Validate
{
    protected $rule = [
        'name|姓名'=>[
            'require'=>'require',
            'length'=>'5,20',
            'chsAlphaNum'=>'chsAlphaNum'
        ],
        'email|邮箱'=>[
            'require'=>'require',
            'email'=>'email',
            'unique'=>'user',
        ],
        'mobile|手机'=>[
            'require'=>'require',
            'mobile'=>'mobile',
            'unique'=>'user',
            'number'=>'number',
        ],
        'password|密码'=>[
            'require'=>'require',
            'length'=>'6,20',
            'confirm'=>'confirm',
        ]

    ];

}