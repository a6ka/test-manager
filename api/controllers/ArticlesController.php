<?php

namespace api\controllers;

use common\models\Article;
use common\models\Audios;
use common\models\Documents;
use common\models\Images;
use common\models\Photos360;
use common\models\Videos;
use common\models\Videos360;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;

/**
 * Models Controller API
 */
class ArticlesController extends ActiveController
{
    public $modelClass = 'common\models\Article';

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
            'query' => Article::find(),
            'pagination' => false,
        ]);
        return $activeData;
    }

    public function actionView($id)
    {
        $model = Article::findOne($id);

        $model->media['images'] = Images::findAll(['article_id' => $model->id]);
        $model->media['videos'] = Videos::findAll(['article_id' => $model->id]);
        $model->media['documents'] = Documents::findAll(['article_id' => $model->id]);
        $model->media['photos360'] = Photos360::findAll(['article_id' => $model->id]);
        $model->media['audios'] = Audios::findAll(['article_id' => $model->id]);

        if (isset($model)) {
            return $model;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
}