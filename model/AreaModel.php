<?php

namespace plugins\area\model;

use plugins\area\validate\AreaValidate;
use think\Model;

class AreaModel extends Model
{
    public static function areas($data)
    {
        $validate = new AreaValidate();
        if (!$validate->scene("areas")->check($data)) {
            return _array(["code" => 1, "message" => $validate->getError()]);
        }
        if (in_array($data["flag"], [3, 4]) && !$validate->scene("code")->check($data)) {
            return _array(["code" => 1, "message" => $validate->getError()]);
        }
        $items = [];
        switch ($data["flag"]) {
            case 1:
            case 2:
                $items = (new AreaModel())->where("rank", $data["flag"])->order("id")->select();
                break;
            case 3:
            case 4:
                $items = (new AreaModel())->where([
                    "rank" => $data["flag"] - 1,
                    "area_code" => $data["code"]
                ])->order("id")->select();
                break;
        }
        return _array(["data" => $items]);
    }

    public static function location($data)
    {
        $item["province"] = !empty($data["province"]) ? (new AreaModel())->where("code", $data["province"])->value("name") : "";
        $item["city"] = !empty($data["city"]) ? (new AreaModel())->where("code", $data["city"])->value("name") : "";
        $item["area"] = !empty($data["area"]) ? (new AreaModel())->where("code", $data["area"])->value("name") : "";
        $item["location"] = !empty($data["location"]) ? $data["location"] : "";
        return _array(["data" => ($item["province"] === $item["city"] ? $item["province"] : $item["province"] . $item["city"]) . $item["area"] . $item["location"]]);
    }

    public static function ip($data)
    {
        $config = (new AreaConfigModel())->find();
        $item = json_decode(cmf_curl_get("http://api.map.baidu.com/location/ip?ak={$config['ak_server']}&coor=bd09ll&ip={$data['ip']}"), true);
        return $item["status"] === 0 ? _array(["data" => $item["content"]]) : _array(["code" => 1, "message" => $item["message"]]);
    }

    public static function address($data)
    {
        $validate = new AreaValidate();
        if (!$validate->scene("coordinate")->check($data)) {
            return _array(["code" => 1, "message" => $validate->getError()]);
        }
        $config = (new AreaConfigModel())->find();
        $item = json_decode(cmf_curl_get("http://api.map.baidu.com/reverse_geocoding/v3/?ak={$config['ak_server']}&output=json&location={$data['coordinate']}"), true);
        return $item["status"] === 0 ? _array(["data" => $item["result"]["addressComponent"]]) : _array(["code" => 1, "message" => $item["msg"]]);
    }

    public static function coordinate($data)
    {
        $validate = new AreaValidate();
        if (!$validate->scene("address")->check($data)) {
            return _array(["code" => 1, "message" => $validate->getError()]);
        }
        $config = (new AreaConfigModel())->find();
        $item = json_decode(cmf_curl_get("http://api.map.baidu.com/geocoding/v3/?ak={$config['ak_server']}&output=json&address={$data['address']}"), true);
        return $item["status"] === 0 ? _array(["data" => $item["result"]["location"]]) : _array(["code" => 1, "message" => $item["msg"]]);
    }
}