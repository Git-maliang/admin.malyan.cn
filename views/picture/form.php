<?php

use yii\helpers\Url;
use app\models\Album;
use app\components\helpers\Html;
use app\components\widgets\ActiveForm;

/* @var $model \app\models\Picture */
$isNewRecord = $model->isNewRecord;
$this->title = Yii::t('common', $isNewRecord ? 'Create Title' : 'Update Title') . Yii::t('module', 'Picture');
$this->registerJsFile('js/upload.js', ['depends' => 'app\assets\AppAsset']);
?>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'album')->dropDownList(Album::albumArray(), ['prompt' => '请选择']);; ?>
<?= $form->field($model, 'picture', [
    'template' => '{label}<div id="preview">'. Html::img($isNewRecord ? '/images/upload.png' : $model->picture, ['id' => 'imageBox', 'border' => 0, 'width' => $isNewRecord ? 90 : '90%', 'onclick' => "$('#previewImg').click();"]) .'</div>{input}{hint}{error}'
])->fileInput(['style' => 'display:none', 'id' => 'previewImg', 'onchange' => 'previewImage(this)']); ?>
<?= $form->field($model, 'describe')->textarea(['rows' => 5]); ?>
<div class="form-group">
    <?= Html::submitButton(Yii::t('common', $isNewRecord ? 'Create' : 'Update'), ['class' => $isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
</div>
<?php ActiveForm::end(); ?>
