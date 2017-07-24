<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 17/6/22
 * Time: 上午8:20
 */

namespace app\components\widgets;

use Yii;
use yii\bootstrap\Html;
use yii\bootstrap\Widget;
use yii\helpers\ArrayHelper;
use yii\base\InvalidConfigException;

class Nav extends Widget
{
    public $items = [];

    public $options = ['class' => 'nav nav-list'];
    
    public $route;
    
    public $params;

    public function run(){
        return $this->renderItems();
    }

    /**
     * Renders widget items.
     */
    public function renderItems()
    {
        $items = [];
        foreach ($this->items as $i => $item) {
            $items[] = $this->renderItem($item);
        }

        return Html::tag('ul', implode("\n", $items), $this->options);
    }

    /**
     * Renders a widget's item.
     * @param string|array $item the item to render.
     * @return string the rendering result.
     * @throws InvalidConfigException
     */
    public function renderItem($item)
    {
        $label = isset($item['icon']) ? Html::tag('i', null, ['class' => 'menu-icon fa ' . $item['icon']]) : '';
        $label .= Html::tag('span', Html::encode($item['label']), ['class' => 'menu-text']);
        $items = ArrayHelper::getValue($item, 'items');
        $url = ArrayHelper::getValue($item, 'url', '#');
        $active = $this->isItemActive($item);

        $options = [];
        $linkOptions = [];
        $dropDown = '';
        if (is_array($items)) {
            $label .= Html::tag('b', null, ['class' => 'arrow fa fa-angle-down']);
            Html::addCssClass($linkOptions, 'dropdown-toggle');
            $dropDown = $this->renderDropdown($items, $active);
        }

        if($active){
            Html::addCssClass($options, 'active');
            Html::addCssClass($options, 'open');
        }

        return Html::tag('li', Html::a($label, [$url], $linkOptions). Html::tag('b', null, ['class' => 'arrow']) . $dropDown, $options);
    }

    /**
     * Checks whether a menu item is active.
     * This is done by checking if [[route]] and [[params]] match that specified in the `url` option of the menu item.
     * When the `url` option of a menu item is specified in terms of an array, its first element is treated
     * as the route for the item and the rest of the elements are the associated parameters.
     * Only when its route and parameters match [[route]] and [[params]], respectively, will a menu item
     * be considered active.
     * @param array $item the menu item to be checked
     * @return boolean whether the menu item is active
     */
    protected function isItemActive($item)
    {
        if (isset($item['url']) && $item['url']) {
            if (Yii::$app->controller->id . '/' . Yii::$app->controller->action->id === $item['url']) {
                return true;
            }
        }
        return false;
    }

    /**
     * Renders the given items as a dropdown.
     * This method is called to create sub-menus.
     * @param array $items the given items. Please refer to [[Dropdown::items]] for the array structure.
     * @param array $parentItem the parent item information. Please refer to [[items]] for the structure of this array.
     * @return string the rendering result.
     * @since 2.0.1
     */
    protected function renderDropdown($items, &$active)
    {
        $data = [];
        foreach ($items as $i => $item) {
            $data[] = $this->renderDropdownItem($item, $active);
        }

        return Html::tag('ul', implode("\n", $data), ['class' => 'submenu']);
    }

    public function renderDropdownItem($item, &$parentActive)
    {
        $label = Html::tag('i', null, ['class' => 'menu-icon fa fa-angle-double-right']);
        $label .= Html::tag('span', Html::encode($item['label']), ['class' => 'menu-text']);
        $url = ArrayHelper::getValue($item, 'url', '#');
        $active = $this->isItemActive($item);

        $options = [];
        if($active){
            $parentActive = true;
            Html::addCssClass($options, 'active');
        }

        return Html::tag('li', Html::a($label, [$url]). Html::tag('b', null, ['class' => 'arrow']), $options);
    }
}