<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "projects".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $project_name
 * @property integer $created_at
 *
 * @property User $user
 */
class Projects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'projects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'project_name', 'created_at'], 'required'],
            [['user_id', 'created_at'], 'integer'],
            [['project_name'], 'string', 'max' => 255],
            [['project_name'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'project_name' => 'Project Name',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
