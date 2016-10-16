<?php

namespace api\controllers;

use Yii;
use common\models\Videos;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

/**
 * Videos Controller API
 */
class VideosController extends ActiveController
{
    public $modelClass = 'common\models\Videos';

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
            'query' => Videos::find()->where(['not', ['model_id' => null]]),
            'pagination' => false,
        ]);
        return $activeData;
    }

    public function actionByModel($id){
        $activeData = new ActiveDataProvider([
            'query' => Videos::find()->where(['model_id' => $id]),
        ]);
        return $activeData;
    }
}