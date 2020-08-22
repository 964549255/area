<?php

namespace plugins\area\controller;

use cmf\controller\PluginAdminBaseController;
use plugins\area\model\AreaConfigModel;
use plugins\area\model\AreaModel;
use plugins\area\validate\AreaValidate;

class AdminIndexController extends PluginAdminBaseController
{
    /**
     * @adminMenu(
     *     "name" => "地区模块",
     *     "parent" => "admin/Plugin/default",
     *     "display" => true,
     *     "hasView" => true,
     *     "order" => 1000,
     * )
     */
    public function index()
    {
        $this->redirect(cmf_plugin_url("Area://admin_area_config/index"));
    }

    /**
     * @adminMenu(
     *     "name" => "地区组件",
     *     "parent" => "AdminIndex/index",
     *     "display" => true,
     *     "hasView" => true,
     *     "order" => 1000,
     * )
     */
    public function component()
    {
        $search = input("get.search/a");
        if (!empty($search["address"])) {
            $data = AreaModel::coordinate(["address" => $search["address"]]);
            if ($data["code"] === 200) {
                $coordinate[0] = $data["data"]["lng"];
                $coordinate[1] = $data["data"]["lat"];
            } else {
                return json($data);
            }
        } else {
            $data = AreaModel::ip(["ip" => ""]);
            if ($data["code"] === 200) {
                $coordinate[0] = $data["data"]["point"]["x"];
                $coordinate[1] = $data["data"]["point"]["y"];
            } else {
                return json($data);
            }
        }
        return $this->fetch("", [
            "ak" => (new AreaConfigModel())->value("ak_browser"),
            "coordinate" => $coordinate,
            "search" => $search
        ]);
    }

    public function map()
    {
        $data = input("get.");
        $validate = new AreaValidate();
        if (!$validate->scene("coordinate")->check($data)) {
            return json(_array(["code" => 1, "message" => $validate->getError()]));
        }
        return $this->fetch("", [
            "ak" => (new AreaConfigModel())->value("ak_browser"),
            "coordinate" => explode(",", $data["coordinate"])
        ]);
    }
}