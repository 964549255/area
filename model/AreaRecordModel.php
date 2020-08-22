<?php

namespace plugins\area\model;

use plugins\area\validate\AreaRecordValidate;
use think\Model;
use traits\model\SoftDelete;

class AreaRecordModel extends Model
{
    use SoftDelete;

    protected $autoWriteTimestamp = true;

    public static function add($data)
    {
        $validate = new AreaRecordValidate();
        if (!$validate->scene("add")->check($data)) {
            return _array(["code" => 1, "message" => $validate->getError()]);
        }
        AreaRecordModel::destroy($data);
        AreaRecordModel::create($data, true);
        return _array();
    }

    public static function clear($data)
    {
        $validate = new AreaRecordValidate();
        if (!$validate->scene("member_id")->check($data)) {
            return _array(["code" => 1, "message" => $validate->getError()]);
        }
        AreaRecordModel::destroy($data);
        return _array();
    }
}