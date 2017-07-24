<?php

use app\components\helpers\Html;
use app\components\widgets\GridView;

/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $searchModel \app\models\search\RoleSearch */

$this->title = Yii::t('module', 'Role') . Yii::t('common', 'List Title');
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('search', ['searchModel' => $searchModel]); ?>
<p>
    <?= Html::a(Yii::t('button', 'Create Role'), ['role/create'], ['class' => 'btn btn-success mr-5', 'target' => '_blank']); ?>
</p>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\CheckBoxColumn'],
        'name',
        'describe',
        'created_at:datetime',
        ['class' => 'app\components\grid\ActionColumn', 'module' => Yii::t('module', 'Role'), 'template' => '{update}{delete}{auth}']
    ]
]); ?>
