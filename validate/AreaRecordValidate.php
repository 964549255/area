<?php

namespace plugins\area\validate;

use think\Validate;

class AreaRecordValidate extends Validate
{
    protected $rule = [
        "area_code" => "require",
        "member_id" => "require"
    ];

    protected $message = [
        "area_code.require" => "地区编码 为空",
        "member_id.require" => "用户编号 为空"
    ];

    protected $scene = [
        "add" => ["area_code", "member_id"],
        "member_id" => ["member_id"]
    ];
}