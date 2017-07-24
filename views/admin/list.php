<?php

use app\models\Admin;
use app\components\helpers\Html;
use app\components\widgets\GridView;

/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $searchModel \app\models\search\AdminSearch */

$this->title = Yii::t('module', 'Admin') . Yii::t('common', 'List Title');
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('search', ['searchModel' => $searchModel]); ?>
<p>
    <?= Html::a(Yii::t('button', 'Create Admin'), ['admin/create'], ['class' => 'btn btn-success mr-5', 'target' => '_blank']); ?>
</p>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\CheckBoxColumn'],
        'id',
        'username',
        'roleName.item_name',
        'real_name',
        'mobile:mobile',
        'email:email',
        ['attribute' => 'create_id', 'format' => ['array', Admin::adminArray()]],
        ['attribute' => 'status', 'format' => ['array', Admin::$statusArray]],
        'created_at:datetime',
        ['class' => 'app\components\grid\ActionColumn', 'module' => Yii::t('module', 'Admin') ]
    ]
]); ?>
