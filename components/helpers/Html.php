<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 17/6/23
 * Time: 下午4:30
 */

namespace app\components\helpers;

use yii\helpers\Url;
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
}