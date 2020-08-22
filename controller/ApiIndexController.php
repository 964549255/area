<?php

namespace plugins\area\controller;

use cmf\controller\PluginRestBaseController;
use plugins\area\model\AreaModel;
use plugins\area\model\AreaRecordModel;
use plugins\area\validate\AreaRecordValidate;

class ApiIndexController extends PluginRestBaseController
{
    public function areas()
    {
        $data = input("post.");
        return json(AreaModel::areas($data));
    }

    public function ip()
    {
        $data = input("post.");
        return json(AreaModel::ip($data));
    }

    public function address()
    {
        $data = input("post.");
        return json(AreaModel::address($data));
    }

    public function coordinate()
    {
        $data = input("post.");
        return json(AreaModel::coordinate($data));
    }

    public function addRecord()
    {
        $data = input("post.");
        return json(AreaRecordModel::add($data));
    }

    public function clearRecord()
    {
        $data = input("post.");
        return json(AreaRecordModel::clear($data));
    }

    public function getAllRecord()
    {
        $data = input("post.");
        $validate = new AreaRecordValidate();
        if (!$validate->scene("member_id")->check($data)) {
            return json(_array(["code" => 1, "message" => $validate->getError()]));
        }
        $items = (new AreaRecordModel())->alias("a")->join("area b", "a.area_code = b.code")->where("a.member_id", $data["member_id"])->field("b.*")->order("a.id desc")->limit(!empty($data["limit"]) ? $data["limit"] : 10)->select();
        return json(_array(["data" => $items]));
    }
}