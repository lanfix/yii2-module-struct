<?php

namespace app\modules\admin\assets;

use yii\bootstrap\BootstrapAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

class AppAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web/admin/';

    public $css = [];

    public $js = [];

    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class
    ];

}
