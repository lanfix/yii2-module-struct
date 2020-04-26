<?php

namespace app\modules\frontend\assets;

use yii\bootstrap\BootstrapAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

class AppAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web/frontend/';

    public $css = [];

    public $js = [];

    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
    ];

}
