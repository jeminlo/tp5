<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/13
 * Time: 17:23
 */

namespace app\common\validate;


use think\Validate;

class ArticleCategory extends Validate
{
    protected $rule = [
        'name|栏目名称' => 'require|length:5,20|chaAlpha',
    ];

}