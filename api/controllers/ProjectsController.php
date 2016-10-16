<?php

namespace api\controllers;

use common\models\Projects;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;

/**
 * Projects Controller API
 */
class ProjectsController extends ActiveController
{
    public $modelClass = 'common\models\Projects';

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
        unset($actions['index'], $actions['view']);
        return $actions;
    }

    public function actionIndex(){
        $activeData = new ActiveDataProvider([
            'query' => Projects::find(),
            'pagination' => false,
        ]);
        return $activeData;
    }

    public function actionView($id)
    {
        $model = Projects::findOne($id);

        if (isset($model)) {
            return $model;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
}