<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%picture}}".
 *
 * @property integer $id
 * @property integer $album
 * @property string $picture
 * @property string $describe
 * @property integer $created_at
 */
class Picture extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%picture}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $required = ['album'];
        if($this->isNewRecord){
            $required[] = 'picture';
        }
        return [
            [$required, 'required'],
            [['album', 'created_at'], 'integer'],
            [['picture', 'describe'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'album' => '相册',
            'picture' => '照片',
            'describe' => '描述',
            'created_at' => '创建时间',
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if($this->isNewRecord){
            $this->created_at = time();
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}