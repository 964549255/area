<?php

namespace plugins\area\validate;

use think\Validate;

class AreaConfigValidate extends Validate
{
    protected $rule = [
        "id" => "require",
        "ak_server" => "require",
        "ak_browser" => "require"
    ];

    protected $message = [
        "id.require" => "配置编号 为空",
        "ak_server.require" => "应用密钥(服务端) 为空",
        "ak_browser.require" => "应用密钥(浏览器端) 为空"
    ];

    protected $scene = [
        "edit" => ["id", "ak_server", "ak_browser"]
    ];
}