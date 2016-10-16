<?php

namespace api\modules\v1\controllers;

use api\modules\v1\models\Model;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

/**
 * Models Controller API
 */
class ModelsController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Model';

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
            'query' => Model::find(),
            'pagination' => false,
        ]);
        return $activeData;
    }
}