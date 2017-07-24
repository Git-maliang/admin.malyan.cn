<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "{{%auth_item_child}}".
 *
 * @property string $parent
 * @property string $child
 *
 * @property AuthItem $parent0
 * @property AuthItem $child0
 */
class AuthItemChild extends \yii\db\ActiveRecord
{
    const CACHE_ALLOWED_ROUTE = 'admin_allowed_route';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auth_item_child}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent', 'child'], 'required'],
            [['parent', 'child'], 'string', 'max' => 64],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => AuthItem::className(), 'targetAttribute' => ['parent' => 'name']],
            [['child'], 'exist', 'skipOnError' => true, 'targetClass' => AuthItem::className(), 'targetAttribute' => ['child' => 'name']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'parent' => '角色',
            'child' => '权限',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentItem()
    {
        return $this->hasOne(AuthItem::className(), ['name' => 'parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildItem()
    {
        return $this->hasOne(AuthItem::className(), ['name' => 'child'])->orderBy(['created_at' => SORT_ASC]);
    }
    
    /**
     *  获取用户权限
     * @param string $role
     * @return array|null
     */
    public static function allowedRoute($role = '')
    {
        if($role){
            // 从缓存中取出权限
            $cache =Yii::$app->cache;
            $allowedRoute = $cache->get(self::CACHE_ALLOWED_ROUTE);
            if($allowedRoute === false) {
                $allowedRoute = self::find()->select('child')->where(['parent' => $role])->column();
                $cache->set(self::CACHE_ALLOWED_ROUTE, $allowedRoute);
            }
            return $allowedRoute;
        }
        return [];
    }

    /**
     * 权限
     * @param $role
     */
    public static function getRoleData($role)
    {
        $permissions = AuthItemChild::find()->select('child')->where(['parent' => $role])->column();
        $menus = Menu::find()->joinWith(['child' => function(ActiveQuery $query){
            $query->joinWith('childItem');
        }])->orderBy(['sort' => SORT_ASC])->all();
        $data = [];
        foreach ($menus as $menu){
            if($menu->pid){
                $i = isset($data[$menu->pid]['children']) ? count($data[$menu->pid]['children']) : 0;
                $data[$menu->pid]['children'][$i] = [
                    'name' => $menu->name,
                    'checkboxValue' => $menu->route,
                    'checked' => in_array($menu->route, $permissions)
                ];
                if($menu->child){
                    $data[$menu->pid]['children'][$i]['spread'] = true;
                    foreach ($menu->child as $val){
                        $data[$menu->pid]['children'][$i]['children'][] = [
                            'name' => $val->childItem->describe,
                            'checkboxValue' => $val->child,
                            'checked' => in_array($val->child, $permissions)
                        ];
                    }
                }
            }else{
                $data[$menu->id]['name'] = $menu->name;
                $data[$menu->id]['spread'] = true;
                $data[$menu->id]['checkboxValue'] = $menu->route;
                $data[$menu->id]['checked'] = in_array($menu->route, $permissions);
            }
        }
        return $data;
    }
}
