<?php

use app\components\widgets\DetailView;

/* @var $model \app\models\Picture */

$this->title = Yii::t('module', 'Picture') . Yii::t('common', 'View Title');
?>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        ['attribute' => 'album', 'format' => ['array', \app\models\Album::albumArray()]],
        ['attribute' => 'url', 'format' => ['image', ['width' => 160, 'height' => 160]]],
        'describe',
        'created_at:datetime'
    ]
]);?>
