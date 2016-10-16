<?php

namespace api\controllers;

use Yii;
use common\models\Audios;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

/**
 * Audios Controller API
 */
class AudiosController extends ActiveController
{
    public $modelClass = 'common\models\Audios';

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
            'query' => Audios::find()->where(['not', ['model_id' => null]]),
            'pagination' => false,
        ]);
        return $activeData;
    }

    public function actionByModel($id){
        $activeData = new ActiveDataProvider([
            'query' => Audios::find()->where(['model_id' => $id]),
        ]);
        return $activeData;
    }
}