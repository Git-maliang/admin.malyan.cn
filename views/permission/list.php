<?php

use app\components\helpers\Html;
use app\components\widgets\GridView;

/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $searchModel \app\models\search\PermissionSearch */

$this->title = Yii::t('module', 'Permission') . Yii::t('common', 'List Title');
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('search', ['searchModel' => $searchModel]); ?>
    <p>
        <?= Html::a(Yii::t('button', 'Create Permission'), ['permission/create'], ['class' => 'btn btn-success mr-5', 'target' => '_blank']); ?>
    </p>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\CheckBoxColumn'],
        'describe',
        'name',
        'created_at:datetime',
        ['class' => 'app\components\grid\ActionColumn', 'module' => Yii::t('module', 'Permission'), 'template' => '{update}{delete}']
    ]
]); ?>