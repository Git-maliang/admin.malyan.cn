<?php

namespace app\models\search;

use yii\base\Model;
use yii\helpers\ArrayHelper;
use app\models\OperateLog;
use yii\data\ActiveDataProvider;

/**
 * Class OperateSearch
 * @package app\models\search
 */
class OperateSearch extends OperateLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'module', 'admin_id'], 'integer']
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
            'type' => $this->type,
            'module' => $this->module,
            'admin_id' => $this->admin_id
        ]);

        return $dataProvider;
    }
}
