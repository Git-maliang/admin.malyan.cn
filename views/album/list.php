<?php

use app\components\helpers\Html;
use app\components\widgets\GridView;

/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $searchModel \app\models\search\AlbumSearch */

$this->title = Yii::t('module', 'Album') . Yii::t('common', 'List Title');
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('search', ['searchModel' => $searchModel]); ?>
<p>
    <?= Html::a(Yii::t('button', 'Create Album'), ['album/create'], ['class' => 'btn btn-success mr-5', 'target' => '_blank']); ?>
</p>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\CheckboxColumn'],
        'id',
        'name',
        ['attribute' => 'cover', 'format' => ['image', ['width' => 32, 'height' => 32]]],
        'created_at:datetime',
        ['class' => 'app\components\grid\ActionColumn', 'module' => Yii::t('module', 'Album')]
    ]
]); ?>
