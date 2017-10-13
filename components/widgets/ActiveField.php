<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 17/6/23
 * Time: 下午4:41
 */

namespace app\components\widgets;

use app\components\helpers\Html;

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

    /**
     * Renders a file input.
     * This method will generate the `name` and `value` tag attributes automatically for the model attribute
     * unless they are explicitly specified in `$options`.
     * @param array $options the tag options in terms of name-value pairs. These will be rendered as
     * the attributes of the resulting tag. The values will be HTML-encoded using [[Html::encode()]].
     *
     * If you set a custom `id` for the input element, you may need to adjust the [[$selectors]] accordingly.
     *
     * @return $this the field object itself.
     */
    public function fileInput($options = [])
    {
        // https://github.com/yiisoft/yii2/pull/795
        if ($this->inputOptions !== ['class' => 'form-control']) {
            $options = array_merge($this->inputOptions, $options);
        }
        // https://github.com/yiisoft/yii2/issues/8779
        if (!isset($this->form->options['enctype'])) {
            $this->form->options['enctype'] = 'multipart/form-data';
        }
        $this->addAriaAttributes($options);
        $this->adjustLabelFor($options);
        $this->parts['{input}'] = Html::activeFileInput($this->model, $this->attribute, $options);

        return $this;
    }
}