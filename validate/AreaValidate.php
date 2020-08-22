<?php

namespace plugins\area\validate;

use think\Validate;

class AreaValidate extends Validate
{
    protected $rule = [
        "flag" => "require",
        "code" => "require",
        "address" => "require",
        "coordinate" => "require"
    ];

    protected $message = [
        "flag.require" => "标志参数 为空",
        "code.require" => "地区编码 为空",
        "address.require" => "地址参数 为空",
        "coordinate.require" => "坐标参数 为空"
    ];

    protected $scene = [
        "code" => ["code"],
        "address" => ["address"],
        "coordinate" => ["coordinate"],
        "areas" => ["flag"]
    ];
}