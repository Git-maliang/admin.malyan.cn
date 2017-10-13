<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 17/6/23
 * Time: 下午4:30
 */

namespace app\components\helpers;

use yii\helpers\Url;
use yii\base\Model;
use app\models\AuthItem;
use yii\web\NotFoundHttpException;

/**
 * Class Html
 * @package app\components\helpers
 */
class Html extends \yii\bootstrap\Html
{
    public static function a($text, $url = null, $options = [])
    {
        if(AuthItem::can($url[0])){
            return '';
        }
        if ($url !== null) {
            $options['href'] = Url::to($url);
        }
        return static::tag('a', $text, $options);
    }

    /**
     * Generates a file input tag for the given model attribute.
     * This method will generate the "name" and "value" tag attributes automatically for the model attribute
     * unless they are explicitly specified in `$options`.
     * @param Model $model the model object
     * @param string $attribute the attribute name or expression. See [[getAttributeName()]] for the format
     * about attribute expression.
     * @param array $options the tag options in terms of name-value pairs. These will be rendered as
     * the attributes of the resulting tag. The values will be HTML-encoded using [[encode()]].
     * See [[renderTagAttributes()]] for details on how attributes are being rendered.
     * @return string the generated input tag
     */
    public static function activeFileInput($model, $attribute, $options = [])
    {
        // add a hidden field so that if a model only has a file field, we can
        // still use isset($_POST[$modelClass]) to detect if the input is submitted
        $hiddenOptions = ['id' => null, 'value' => $model->$attribute ? $model->$attribute : ''];
        if (isset($options['name'])) {
            $hiddenOptions['name'] = $options['name'];
        }
        return static::activeHiddenInput($model, $attribute, $hiddenOptions)
        . static::activeInput('file', $model, $attribute, $options);
    }
}