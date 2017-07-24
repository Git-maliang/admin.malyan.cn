<?php

use app\components\widgets\DetailView;

/* @var $model \app\models\Menu */

$this->title = Yii::t('module', 'Menu') . Yii::t('common', 'View Title');
?>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'name',
        'icon:icon',
        'route',
        'sort',
        'created_at:datetime'
    ]
]);?>
