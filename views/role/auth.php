<?php

use app\components\helpers\Html;
use app\components\widgets\Tree;
use app\components\widgets\ActiveForm;

/* @var $model \app\models\AuthItem */
$this->title = Yii::t('common',  'Auth Title');
Tree::widget(['data' => $data]);
?>
<?php $form = ActiveForm::begin(); ?>
<div  class="form-group">
    <ul id="tree"></ul>
</div>
<div class="form-group">
    <?= Html::submitButton(Yii::t('common', 'Confirm'), ['class' => 'btn btn-success']); ?>
</div>
<?php ActiveForm::end(); ?>
