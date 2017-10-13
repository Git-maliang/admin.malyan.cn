<?php

use app\components\widgets\DetailView;

/* @var $model \app\models\Album */

$this->title = Yii::t('module', 'Album') . Yii::t('common', 'View Title');
?>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'name',
        ['attribute' => 'cover', 'format' => ['image', ['width' => 160, 'height' => 160]]],
        'created_at:datetime'
    ]
]);?>
