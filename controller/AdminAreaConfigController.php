<?php

namespace plugins\area\controller;

use cmf\controller\PluginAdminBaseController;
use plugins\area\model\AreaConfigModel;

class AdminAreaConfigController extends PluginAdminBaseController
{
    /**
     * @adminMenu(
     *     "name" => "地区配置",
     *     "parent" => "AdminIndex/index",
     *     "display" => true,
     *     "hasView" => true,
     *     "order" => 1000,
     * )
     */
    public function index()
    {
        $data = input("post.");
        if (!empty($data)) {
            return json(AreaConfigModel::edit($data));
        } else {
            $item = (new AreaConfigModel())->find();
            return $this->fetch("", [
                "item" => $item
            ]);
        }
    }
}