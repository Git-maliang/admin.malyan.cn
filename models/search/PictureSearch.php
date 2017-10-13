<?php

namespace app\models\search;

use yii\base\Model;
use app\models\Picture;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

/**
 * Class PictureSearch
 * @package app\models\search
 */
class PictureSearch extends Picture
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['describe'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(Array $params)
    {
        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => ArrayHelper::getValue($params, 'per-page', 10)
            ],
        ]);

        $this->load($params);

        if(!$this->validate()) {
            return $dataProvider;
        }

        $query->filterWhere(['like', 'describe', $this->describe]);
        
        return $dataProvider;
    }
}
