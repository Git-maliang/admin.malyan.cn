<?php

use app\components\helpers\Html;
use app\components\widgets\GridView;

/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $searchModel \app\models\search\PictureSearch */

$this->title = Yii::t('module', 'Picture') . Yii::t('common', 'List Title');
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('search', ['searchModel' => $searchModel]); ?>
<p>
    <?= Html::a(Yii::t('button', 'Create Picture'), ['picture/create'], ['class' => 'btn btn-success mr-5', 'target' => '_blank']); ?>
</p>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\CheckboxColumn'],
        'id',
        ['attribute' => 'album', 'format' => ['array', \app\models\Album::albumArray()]],
        ['attribute' => 'picture', 'format' => ['image', ['width' => 32, 'height' => 32]]],
        'describe:truncate',
        'created_at:datetime',
        ['class' => 'app\components\grid\ActionColumn', 'module' => Yii::t('module', 'Picture')]
    ]
]); ?>
