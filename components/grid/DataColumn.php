<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 17/4/13
 * Time: 上午9:31
 */

namespace app\components\grid;

use Yii;
use yii\helpers\Html;

class DataColumn extends \yii\grid\DataColumn
{
    public $encodeLabel = false;
    public $enableSorting = true;
    public $sortLinkOptions = [];
    public $headerOptions = ['class'=>'center'];
    public $contentOptions = ['class' => 'center'];

    /**
     * @inheritdoc
     */
    protected function renderHeaderCellContent()
    {
        if ($this->header !== null || $this->label === null && $this->attribute === null) {
            return parent::renderHeaderCellContent();
        }

        $label = $this->getHeaderCellLabel();
        if ($this->encodeLabel) {
            $label = Html::encode($label);
        }

        if ($this->attribute !== null && $this->enableSorting &&
            ($sort = $this->grid->dataProvider->getSort()) !== false && $sort->hasAttribute($this->attribute)) {
            $this->headerOptions = ['class'=>'sorting center'];
            if($attributeName = Yii::$app->request->get('sort', false)){
                if($attributeName == $this->attribute){
                    $this->headerOptions = ['class'=>'sorting_asc center'];
                }else if($attributeName == '-' . $this->attribute){
                    $this->headerOptions = ['class'=>'sorting_desc center'];
                }
            }
            return $sort->link($this->attribute, array_merge($this->sortLinkOptions, ['label' => $label]));
        } else {
            return $label;
        }
    }
}