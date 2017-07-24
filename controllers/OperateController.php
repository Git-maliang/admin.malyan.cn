<?php

namespace app\controllers;

use Yii;
use app\models\search\OperateSearch;

/**
 * 操作日志
 * Class OperateController
 * @package app\controllers
 */
class OperateController extends Controller
{
    /**
     * 列表
     * @return string
     */
    public function actionList()
    {
        $searchModel = new OperateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('list',[
            'searchModel'=>$searchModel,
            'dataProvider'=>$dataProvider
        ]);
    }
}