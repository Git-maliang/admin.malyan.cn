<?php

namespace app\models\search;

use yii\base\Model;
use app\models\Album;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

/**
 * Class AlbumSearch
 * @package app\models\search
 */
class AlbumSearch extends Album
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 10],
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

        $query->filterWhere(['like', 'name', $this->name]);
        
        return $dataProvider;
    }
}
