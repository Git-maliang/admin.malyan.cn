<?php

namespace app\models\search;

use yii\base\Model;
use app\models\Menu;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

/**
 * Class MenuSearch
 * @package app\models\search
 */
class MenuSearch extends Menu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'route'], 'string', 'max' => 64],
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

        $query->andFilterWhere([
            'name' => $this->name,
            'route' => $this->route
        ]);

        return $dataProvider;
    }
}
