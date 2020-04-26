<?php

namespace app\modules\frontend;

use Yii;

class Module extends \yii\base\Module
{

    public $controllerNamespace = 'app\modules\frontend\controllers';
    public $defaultRoute = 'site/index';
    public $layout = 'main';

    public function init()
    {
        parent::init();
        Yii::$app->errorHandler->errorAction = 'frontend/site/error';
    }

}
