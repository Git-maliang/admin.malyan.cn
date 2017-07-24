<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\widgets\Breadcrumbs;
use app\components\widgets\Alert;
use app\components\widgets\Nav;
use app\components\helpers\MenuHelper;

AppAsset::register($this);
$showMenu = in_array(Yii::$app->controller->action->id, Yii::$app->params['hiddenMenu']);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="<?= Html::encode(Yii::$app->charset); ?>">
    <?= Html::csrfMetaTags(); ?>
    <title><?= Html::encode(Yii::$app->params['title']); ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <?php $this->head(); ?>
</head>
<?php $this->beginBody(); ?>
<body class="no-skin">
<!-- 顶部start -->
<div id="navbar" class="navbar navbar-default navbar-fixed-top">
    <div class="navbar-container" id="navbar-container">
        <?php if ($showMenu === false): ?>
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <?php endif; ?>
        <div class="navbar-header pull-left">
            <a href="<?= Yii::$app->homeUrl ?>" class="navbar-brand">
                <small>
                    <i class="fa fa-leaf"></i>
                    <?= Html::encode(Yii::$app->name); ?>
                </small>
            </a>
        </div>
        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">
                <li class="light-blue">
                    <?= Html::a('<i class="ace-icon fa fa-sign-out"></i>' . Yii::t('common', 'Logout'), ['site/logout'], ['data-method' => 'post']); ?>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- 顶部end -->
<div class="main-container" id="main-container"  style="padding-top: 45px">

    <?php if ($showMenu === false): ?>
    <!-- 左侧start -->
    <div id="sidebar" class="sidebar responsive">
        <div class="sidebar-shortcuts" id="sidebar-shortcuts">
            <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                <?= Html::a('<i class="ace-icon fa fa-plus"></i>', null, ['class' => 'btn btn-success']); ?>
                <?= Html::a('<i class="ace-icon fa fa-book"></i>', null, ['class' => 'btn btn-info']); ?>
                <?= Html::a('<i class="ace-icon fa fa-users"></i>', null, ['class' => 'btn btn-warning']); ?>
                <?= Html::a('<i class="ace-icon fa fa-signal"></i>', null, ['class' => 'btn btn-danger']); ?>
            </div>
            <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                <?= Html::a('', null, ['class' => 'btn btn-success']); ?>
                <?= Html::a('', null, ['class' => 'btn btn-info']); ?>
                <?= Html::a('', null, ['class' => 'btn btn-warning']); ?>
                <?= Html::a('', null, ['class' => 'btn btn-danger']); ?>
            </div>
        </div>
        <!-- 左侧菜单start -->
        <?= Nav::widget(['items' => MenuHelper::getAssignedMenu()]); ?>
        <!-- 左侧菜单end -->
        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
            <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>
    </div>
    <!-- 左侧end -->
    <?php endif; ?>

    <!-- 右侧start   -->
    <div class="main-content">
        <!-- 面包屑start -->
        <?php if (isset($this->params['breadcrumbs'])): ?>
            <div class="breadcrumbs">
                <?= Breadcrumbs::widget([
                    'links' => $this->params['breadcrumbs'],
                    'encodeLabels' => false,
                    'homeLink' => ['label' => '<i class="fa fa-home"></i> ' . Yii::t('yii', 'Home'), 'url' => Yii::$app->homeUrl],
                ]); ?>
            </div>
        <?php endif; ?>
        <!-- 面包屑end-->
        <!-- 内容start -->
        <div class="page-content">
            <?php if ($this->title): ?>
            <div class="page-header">
                <h1><?= Html::encode($this->title); ?></h1>
            </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-xs-12">
                    <?= Alert::widget(); ?>
                    <?= $content; ?>
                </div>
            </div>
        </div>
        <!-- 内容end -->
    </div>
    <!-- 右侧end  -->
    
    <!-- 底部start -->
    <div class="footer">
        <div class="footer-inner">
            <div class="footer-content">
                <span class="pull-left">&copy; My Company <?= date('Y'); ?></span>
                <span class="pull-right"><?= Yii::powered(); ?></span>
            </div>
        </div>
    </div>
    <a class="btn-scroll-up btn btn-sm btn-inverse" id="btn-scroll-up" href="#">
        <i class="fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
    <!-- 底部end -->
</div>
</body>
<?php $this->endBody(); ?>
</html>
<?php $this->endPage(); ?>
