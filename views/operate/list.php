<?php

use app\models\Admin;
use app\models\OperateLog;
use app\components\widgets\GridView;

/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $searchModel \app\models\search\OperateSearch */

$this->title = Yii::t('module', 'Operate') . Yii::t('common', 'List Title');
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('search', ['searchModel' => $searchModel]); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\CheckBoxColumn'],
        'id',
        'operate_id',
        ['attribute' => 'type', 'format' => ['array', OperateLog::typeArray()]],
        ['attribute' => 'module', 'format' => ['array', OperateLog::moduleArray()]],
        'describe:truncate',
        ['attribute' => 'admin_id', 'format' => ['array', Admin::adminArray()]],
        'ip:ip',
        'created_at:datetime'
    ]
]); ?>
