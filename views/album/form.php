<?php

use yii\helpers\Url;
use app\components\helpers\Html;
use app\components\widgets\ActiveForm;

/* @var $model \app\models\Album */
$isNewRecord = $model->isNewRecord;
$this->title = Yii::t('common', $isNewRecord ? 'Create Title' : 'Update Title') . Yii::t('module', 'Album');
$this->registerJsFile('js/upload.js', ['depends' => 'app\assets\AppAsset']);
?>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'name', ['enableAjaxValidation' => true]); ?>
<?= $form->field($model, 'cover', [
    'template' => '{label}<div id="preview">'. Html::img($isNewRecord ? '/images/upload.png' : $model->cover, ['id' => 'imageBox', 'border' => 0, 'width' => $isNewRecord ? 90 : '90%', 'onclick' => "$('#previewImg').click();"]) .'</div>{input}{hint}{error}'
])->fileInput(['style' => 'display:none', 'id' => 'previewImg', 'onchange' => 'previewImage(this)']); ?>
<div class="form-group">
    <?= Html::submitButton(Yii::t('common', $isNewRecord ? 'Create' : 'Update'), ['class' => $isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
</div>
<?php ActiveForm::end(); ?>
