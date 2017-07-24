<?php

use app\components\helpers\Html;
use app\components\widgets\ActiveForm;

/* @var $model \app\models\AuthItem */
$isNewRecord = $model->isNewRecord;
$this->title = Yii::t('common', $isNewRecord ? 'Create Title' : 'Update Title') . Yii::t('module', 'Role');
?>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'name'); ?>
<?= $form->field($model, 'describe'); ?>
<div class="form-group">
    <?= Html::submitButton(Yii::t('common', $isNewRecord ? 'Create' : 'Update'), ['class' => $isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
</div>
<?php ActiveForm::end(); ?>
