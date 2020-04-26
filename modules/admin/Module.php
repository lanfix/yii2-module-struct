<?php

namespace app\modules\admin;

use Yii;

class Module extends \yii\base\Module
{

    public $controllerNamespace = 'app\modules\admin\controllers';
    public $defaultRoute = 'site/index';
    public $layout = 'main';

    public function init()
    {
        Yii::$app->errorHandler->errorAction = 'admin/site/error';
        parent::init();
    }

}
