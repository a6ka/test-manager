<?php

namespace api\controllers;

//use api\modules\v1\models\Model;
use common\models\Audios;
use common\models\Documents;
use common\models\Images;
use common\models\Model;
use common\models\Photos360;
use common\models\Videos;
use common\models\Videos360;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;

/**
 * Models Controller API
 */
class ModelsController extends ActiveController
{
    public $modelClass = 'common\models\Model';

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
            'query' => Model::find(),
            'pagination' => false,
            'sort' => [
                'defaultOrder' => [
                    'start_date' => SORT_ASC,
                    'end_date' => SORT_ASC,
                ]
            ],
        ]);
        return $activeData;
    }

    public function actionView($id)
    {
        $model = Model::findOne($id);

        $model->media['images'] = Images::findAll(['model_id' => $model->id]);
        $model->media['videos'] = Videos::findAll(['model_id' => $model->id]);
        $model->media['documents'] = Documents::findAll(['model_id' => $model->id]);
        $model->media['photos360'] = Photos360::findAll(['model_id' => $model->id]);
        $model->media['audios'] = Audios::findAll(['model_id' => $model->id]);

        if (isset($model)) {
            return $model;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }

    public function actionByDate($date){
        $activeData = new ActiveDataProvider([
            'query' => Model::find()->where(['and', "start_date<=$date", "end_date>=$date"]),
        ]);
        return $activeData;
    }

    public function actionByDateAll()
    {

        $data = [];
        $min_date = intval(Model::find()->min('start_date'));

        for ($date = $min_date; $date <= intval(date('Y')); $date++) {
            $data[$date] = Model::find()->where(['and', "start_date<=$date", "end_date>=$date"])->all();
        }

        $activeData = new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => false,
        ]);

        return $activeData;
    }

}