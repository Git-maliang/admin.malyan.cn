<?php

use yii\helpers\Url;
use app\models\Menu;
use app\components\helpers\Html;
use app\components\widgets\ActiveForm;

/* @var $model \app\models\AuthItem */
$isNewRecord = $model->isNewRecord;
$this->title = Yii::t('common', $isNewRecord ? 'Create Title' : 'Update Title') . Yii::t('module', 'Permission');
?>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'describe'); ?>
<?= $form->field($model, 'name'); ?>
<?= $form->field($model, 'levelOne')->dropDownList(Menu::childArray(), ['prompt' => '请选择',]); ?>
<?= $form->field($model, 'levelTwo')->dropDownList($model->levelOne ? Menu::childArray($model->levelOne) : [], ['prompt' => '请选择']); ?>
<div class="form-group">
    <?= Html::submitButton(Yii::t('common', $isNewRecord ? 'Create' : 'Update'), ['class' => $isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
</div>
<?php ActiveForm::end(); ?>
<?php
$levelOneId = Html::getInputId($model, 'levelOne');
$levelTwoId = Html::getInputId($model, 'levelTwo');
$url = Url::toRoute('permission/menu', true);
$js = <<<EOD
    $('#{$levelOneId}').change(function(){
        var pid = $(this).val();
        if(pid){
            $('#$levelTwoId').load('{$url}?id=' + pid);
        }else{
            $('#$levelTwoId').html('<option value="">请选择</option>');
        }
    });
EOD;
$this->registerJs($js);
?>
