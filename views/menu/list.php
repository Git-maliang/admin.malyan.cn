<?php

use app\components\helpers\Html;
use app\components\widgets\GridView;

/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $searchModel \app\models\search\MenuSearch */

$this->title = Yii::t('module', 'Menu') . Yii::t('common', 'List Title');
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('search', ['searchModel' => $searchModel]); ?>
<p>
    <?= Html::a(Yii::t('button', 'Create Menu'), ['menu/create'], ['class' => 'btn btn-success mr-5', 'target' => '_blank']); ?>
    <?= Html::a(Yii::t('button', 'Menu Sort'), ['menu/sort'], ['class' => 'btn btn-warning', 'target' => '_blank']); ?>
</p>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\CheckBoxColumn'],
        'id',
        'name',
        'icon:icon',
        'route',
        'sort',
        'created_at:datetime',
        ['class' => 'app\components\grid\ActionColumn', 'module' => Yii::t('module', 'Menu')]
    ]
]); ?>
