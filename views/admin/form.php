<?php

use yii\helpers\Url;
use app\models\AuthItem;
use app\components\helpers\Html;
use app\components\widgets\ActiveForm;

/* @var $model \app\models\Admin */
$isNewRecord = $model->isNewRecord;
$this->title = Yii::t('common', $isNewRecord ? 'Create Title' : 'Update Title') . Yii::t('module', 'Admin');
?>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'username', ['enableAjaxValidation' => true]); ?>
<?= $form->field($model, 'password',[
    'template' => '{label}<div class="input-group">{input}<span class="input-group-btn"><button class="btn btn-info create-password" type="button">生成密码</button></span></div>{error}',
    'inputOptions' => ['autocomplete' => 'off']
]); ?>
<?= $form->field($model, 'real_name'); ?>
<?= $form->field($model, 'mobile', ['enableAjaxValidation' => true]); ?>
<?= $form->field($model, 'email', ['enableAjaxValidation' => true]); ?>
<?= $form->field($model, 'role')->dropDownList(AuthItem::roleArray(), ['prompt' => '请选择']); ?>
<div class="form-group">
    <?= Html::hiddenInput(null, $model->id, ['id' => Html::getInputId($model, 'id')]); ?>
    <?= Html::submitButton(Yii::t('common', $isNewRecord ? 'Create' : 'Update'), ['class' => $isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
</div>
<?php ActiveForm::end(); ?>
<?php
$passwordId = Html::getInputId($model, 'password');
$url = Url::toRoute('create-password');
$js = <<<EOD
    $('.create-password').on('click', function(){
        $.get('{$url}', null, function(data){
            $('#{$passwordId}').val(data);
        })
    });
EOD;
$this->registerJs($js);
?>
