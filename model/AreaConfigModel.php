<?php

namespace plugins\area\model;

use plugins\area\validate\AreaConfigValidate;
use think\Model;

class AreaConfigModel extends Model
{
    public static function edit($data)
    {
        $validate = new AreaConfigValidate();
        if (!$validate->scene("edit")->check($data)) {
            return _array(["code" => 1, "message" => $validate->getError()]);
        }
        AreaConfigModel::update($data, ["id" => $data["id"]], true);
        return _array();
    }
}