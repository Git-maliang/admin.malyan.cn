<?php

use app\models\Admin;
use app\models\AuthItem;
use app\components\helpers\Html;
use app\components\widgets\ActiveForm;

/* @var $searchModel \app\models\search\AdminSearch */
?>
<?php $form = ActiveForm::begin(['module' => ActiveForm::TYPE_SEARCH]); ?>
<?= $form->field($searchModel, 'username'); ?>
<?= $form->field($searchModel, 'real_name'); ?>
<?= $form->field($searchModel, 'mobile'); ?>
<?= $form->field($searchModel, 'email'); ?>
<?= $form->field($searchModel, 'role')->dropDownList(AuthItem::roleArray(), ['prompt' => Yii::t('common', 'All')]); ?>
<?= $form->field($searchModel, 'create_id')->dropDownList(Admin::adminArray(), ['prompt' => Yii::t('common', 'All')]); ?>
<?= $form->field($searchModel, 'status')->dropDownList(Admin::$statusArray, ['prompt' => Yii::t('common', 'All')]); ?>
<div class="form-group">
    <?= Html::submitButton(Yii::t('common', 'Search'), ['class' => 'btn btn-info mr-5']); ?>
</div>
<?php ActiveForm::end(); ?>
<div class="hr dotted"></div>
