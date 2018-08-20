<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/19
 * Time: 12:39
 */

namespace app\admin\controller;


use app\common\controller\Base;
use app\common\model\Site as SiteModel;
use think\facade\Request;

class Site extends Base
{
    /**
     * 站点设置页
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $siteInfo = SiteModel::find(1);
        $this->view->assign([
            'title' => '站点设置',
            'siteInfo' => $siteInfo,
        ]);
        return $this->view->fetch();
    }

    public function doEdit()
    {
        $data = Request::param();
        $is_update = SiteModel::update($data);
        if ($is_update) {
            $this->success('设置成功');
        } else {
            $this->error('设置失败');
        }
    }
}