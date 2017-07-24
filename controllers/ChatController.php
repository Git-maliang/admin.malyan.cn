<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/6/24
 * Time: 18:55
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;

class ChatController extends Controller
{
    public function actionIndex()
    {
        return $this->renderPartial('index');
    }
}