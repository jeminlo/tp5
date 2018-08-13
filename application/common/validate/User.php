<?php
/**
 * user表验证器
 */

namespace app\common\validate;


use think\Validate;

class User extends Validate
{
    protected $rule = [
        'name|姓名' => 'require|length:5,20|chsAlphaNum',
        'email|邮箱' => 'require|email|unique:user',
        'mobile|手机' => 'require|mobile|unique:user',
        'password|密码' => 'require|length:6,10|alphaNum|confirm'
    ];

}