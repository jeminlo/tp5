<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/9
 * Time: 11:10
 */

namespace app\common;


class Temp
{
    private $name;

    public function __construct($name = 'is me')
    {
        $this->name = $name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return __METHOD__.'--'.$this->name;
    }
}