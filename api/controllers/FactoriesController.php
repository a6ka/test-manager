<?php

namespace api\controllers;

use common\models\Factories;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

/**
 * Models Controller API
 */
class FactoriesController extends ActiveController
{
    public $modelClass = 'common\models\Factories';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
        ];

        return $behaviors;
    }

    public function actions(){
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex(){
        $activeData = new ActiveDataProvider([
            'query' => Factories::find(),
            'pagination' => false,
        ]);
        return $activeData;
    }
}