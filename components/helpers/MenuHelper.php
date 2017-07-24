<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 17/6/22
 * Time: 下午1:36
 */

namespace app\components\helpers;

use Yii;
use yii\base\Widget;
use app\models\Menu;
use app\models\AuthItemChild;

class MenuHelper extends Widget
{
    const CACHE_MENU = 'cache_menu_';

    /**
     * 获取分配的菜单
     * @return array|mixed
     */
    public static function getAssignedMenu()
    {
        $cache = Yii::$app->cache;
        $items = $cache->get(self::CACHE_MENU);
        if($items === false){
            $items = self::handleMenu();
            $cache->set(self::CACHE_MENU, $items, 1800);
        }
        return $items;
    }

    /**
     * 处理菜单
     * @return array
     */
    protected static function handleMenu()
    {
        $role = Yii::$app->session->get('admin_role');
        $allowedRole = Yii::$app->params['allowedRole'];
        $allowedRoute = AuthItemChild::allowedRoute($role);
        $menus = Menu::find()->select(['id', 'pid', 'name', 'route', 'icon'])->orderBy(['pid' => SORT_ASC,'sort' => SORT_ASC])->asArray()->all();
        $data = [];
        foreach ($menus as $menu){
            if(in_array($role, $allowedRole) || in_array($menu['route'], $allowedRoute)){
                if($menu['pid']){
                    $data[$menu['pid']]['items'][] = [
                        'label' => $menu['name'],
                        'url' => $menu['route']
                    ];
                }else{
                    $data[$menu['id']]['label'] = $menu['name'];
                    $data[$menu['id']]['icon'] = $menu['icon'];
                }
            }
        }
        return $data;
    }

}