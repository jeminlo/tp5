<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/13
 * Time: 17:16
 */

namespace app\common\validate;


use think\Validate;

class Article extends Validate
{
    protected $rule = [
        'title|标题' => 'require|length:1,20',
//        'title_img|标题图片' => 'require',
//        'content|文章内容' => 'require',
        'user_id|作者' => 'require',
        'cate_id|栏目名称' => 'require',
    ];

}