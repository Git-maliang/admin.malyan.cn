<?php

namespace app\models\search;

use yii\base\Model;
use yii\db\ActiveQuery;
use app\models\Admin;
use app\models\AuthItem;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use app\components\helpers\MatchHelper;

/**
 * Class MenuSearch
 * @package app\models\search
 */
class AdminSearch extends Admin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_id', 'mobile', 'status'], 'integer'],
            [['username'], 'string', 'max' => 20],
            [['role'], 'string', 'max' => 64],
            [['real_name'], 'string', 'min'=>2, 'max' => 4],
            [['real_name'], 'match', 'pattern' => MatchHelper::$chinese, 'message' => '{attribute}只能为汉字。'],
            [['mobile'], 'match', 'pattern' => MatchHelper::$mobile, 'message' => '{attribute}格式不正确。'],
            [['email'], 'string', 'max' => 50],
            [['email'], 'email'],
            [['create_id'], 'in', 'range' => array_keys(Admin::adminArray())],
            [['status'], 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DISABLE]],
            [['role'], 'in', 'range' => array_keys(AuthItem::roleArray())],
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
        $query = self::find()->joinWith('roleName');

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
            'username' => $this->username,
            'real_name' => $this->real_name,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'create_id' => $this->create_id,
            'status' => $this->status
        ]);

        if($role = $this->role){
            $query->joinWith(['roleName' => function(ActiveQuery $query) use($role){
                $query->andFilterWhere(['item_name' => $role]);
            }]);
        }


        return $dataProvider;
    }
}
