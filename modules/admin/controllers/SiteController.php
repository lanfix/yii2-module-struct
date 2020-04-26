<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;

class SiteController extends Controller
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'view' => '@app/modules/frontend/views/error/404.php',
                'layout' => false,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
