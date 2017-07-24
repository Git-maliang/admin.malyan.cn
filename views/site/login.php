<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\form\LoginForm */

use yii\helpers\Html;
use yii\captcha\Captcha;
use app\assets\LoginAsset;
use yii\bootstrap\ActiveForm;
use app\components\widgets\Alert;

$this->title = 'H+后台管理系统 - 登录';

LoginAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language; ?>">
<head>
    <meta charset="<?= Yii::$app->charset; ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <?= Html::csrfMetaTags(); ?>
    <title><?= Html::encode($this->title); ?></title>
    <?php $this->head(); ?>
</head>
<body  class="signin">
<?php $this->beginBody(); ?>
<?= Alert::widget(['fixedTop' => true]); ?>
<div class="signinpanel">
    <div class="row">
        <div class="col-sm-7"></div>
        <div class="col-sm-5">
             <?php $form = ActiveForm::begin([
                 'errorCssClass' => false,
                 'successCssClass' => false,
                 'enableClientValidation' => false,
                 'fieldConfig' => [
                     'template' => "{input}"
                 ]
             ]); ?>
                <h4 class="no-margins">登录：</h4>
                <p class="m-t-xs p-xxs">登录到H+后台管理系统</p>
                <?= $form->field($model, 'username', [
                    'inputOptions' => [
                        'class' => 'form-control uname',
                        'placeholder' => '用户名',
                        'autocomplete' => 'off',
                    ]
                ]); ?>
                <?= $form->field($model, 'password', [
                    'inputOptions' => [
                        'class' => 'form-control pword m-b',
                        'placeholder' => '密码',
                        'autocomplete' => 'off',
                    ]
                ])->passwordInput(); ?>
                <?= $form->field($model, 'verifyCode', [
                    'options' => ['class' => 'input-group'],
                ])->widget(Captcha::className(), [
                    'template' => '{input}<span class="input-group-addon" style="padding:0">{image}</span>',
                    'options' => [
                        'class' => 'form-control',
                        'placeholder' => '验证码',
                        'autocomplete' => 'off',
                        'maxlength' => 4,
                        'style' => 'color: #333',
                    ],
                    'imageOptions' => [
                        'id' => 'captcha-image',
                        'style' => 'cursor: pointer',
                        'title' => '看不清？点击图片更换'
                    ],
                ]); ?>
                <?= Html::submitButton(Yii::t('common', 'Login'), ['class' => 'btn btn-warning btn-block']); ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
