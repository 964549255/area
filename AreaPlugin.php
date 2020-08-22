<?php

namespace plugins\area;

use cmf\lib\Plugin;

class AreaPlugin extends Plugin
{
    public $info = [
        'name' => 'Area',
        'title' => '地区模块',
        'author' => '徐灵峰',
        'version' => '1.0.0',
        'description' => '地区模块',
        'status' => 1
    ];

    public $hasAdmin = 1;

    public function install()
    {
        return true;
    }

    public function uninstall()
    {
        return true;
    }
}