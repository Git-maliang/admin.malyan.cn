<?php

use app\models\Menu;
use app\components\helpers\Html;
use app\components\widgets\ActiveForm;

/* @var $model \app\models\Menu */
$isNewRecord = $model->isNewRecord;
$this->title = Yii::t('common', $isNewRecord ? 'Create Title' : 'Update Title') . Yii::t('module', 'Menu');
?>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'name'); ?>
<?= $form->field($model, 'pid')->dropDownList(Menu::childArray(), ['prompt' => '请选择']); ?>
<?= $form->field($model, 'icon'); ?>
<?= $form->field($model, 'route'); ?>
<div class="form-group">
    <?= Html::submitButton(Yii::t('common', $isNewRecord ? 'Create' : 'Update'), ['class' => $isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
</div>
<?php ActiveForm::end(); ?>
