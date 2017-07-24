<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 17/6/20
 * Time: 下午5:08
 */
/* @var $model \app\models\System */
use yii\bootstrap\Html;

$this->title = 'My Admin 登录信息';
?>
<h4 class="blue">
    <span class="middle"><i class="ace-icon glyphicon glyphicon-user light-blue bigger-110"></i></span>
    账号信息
</h4>
<div class="profile-user-info">
    <div class="profile-info-row">
        <div class="profile-info-name"> 账号  </div>
        <div class="profile-info-value">
            <span><?= Html::encode($model->username); ?></span>
        </div>
    </div>
    <div class="profile-info-row">
        <div class="profile-info-name"> 角色  </div>
        <div class="profile-info-value">
            <span><?= Html::encode($model->role); ?></span>
        </div>
    </div>
    <div class="profile-info-row">
        <div class="profile-info-name"> 上次登录时间  </div>
        <div class="profile-info-value">
            <span><?= Html::encode($model->lastTime); ?></span>
        </div>
    </div>
    <div class="profile-info-row">
        <div class="profile-info-name"> 上次登录IP  </div>
        <div class="profile-info-value">
            <span><?= Html::encode($model->lastIp); ?></span>
        </div>
    </div>
</div>
<div class="hr hr16 dotted"></div>
<h4 class="blue">
    <span class="middle"><i class="fa fa-desktop light-blue bigger-110"></i></span>
    系统信息
</h4>
<div class="profile-user-info">
    <div class="profile-info-row">
        <div class="profile-info-name"> 操作系统  </div>
        <div class="profile-info-value">
            <span><?= Html::encode($model->system); ?></span>
        </div>
    </div>
    <div class="profile-info-row">
        <div class="profile-info-name"> 服务器软件 </div>
        <div class="profile-info-value">
            <span><?= Html::encode($model->server); ?></span>
        </div>
    </div>
    <div class="profile-info-row">
        <div class="profile-info-name"> MySQL版本 </div>
        <div class="profile-info-value">
            <span><?= Html::encode($model->mysql); ?></span>
        </div>
    </div>
    <div class="profile-info-row">
        <div class="profile-info-name"> PHP版本 </div>
        <div class="profile-info-value">
            <span><?= Html::encode($model->php); ?></span>
        </div>
    </div>
    <div class="profile-info-row">
        <div class="profile-info-name"> Yii版本 </div>
        <div class="profile-info-value">
            <span><?= Html::encode($model->yii); ?></span>
        </div>
    </div>
    <div class="profile-info-row">
        <div class="profile-info-name"> 上传文件 </div>
        <div class="profile-info-value">
            <span><?= Html::encode($model->upload); ?></span>
        </div>
    </div>
</div>
<div class="hr dotted"></div>
