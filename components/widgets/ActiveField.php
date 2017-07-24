<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 17/6/23
 * Time: 下午4:41
 */

namespace app\components\widgets;

use yii\helpers\Html;

class ActiveField extends \yii\bootstrap\ActiveField
{
    private $_skipLabelFor = false;

    public function label($label = null, $options = [])
    {
        if ($label === false) {
            $this->parts['{label}'] = '';
            return $this;
        }

        $options = array_merge($this->labelOptions, $options);
        if ($label !== null) {
            $options['label'] = $label;
        }else{
            $options['label'] = $this->model->getAttributeLabel($this->attribute);
        }

        if ($this->_skipLabelFor) {
            $options['for'] = null;
        }

        if($options['label'] ){
            Html::addCssClass($options, 'colon');
        }

        $this->parts['{label}'] = Html::activeLabel($this->model, $this->attribute, $options);

        return $this;
    }
}