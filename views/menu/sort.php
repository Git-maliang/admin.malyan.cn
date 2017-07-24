<?php

use app\components\helpers\Html;
use app\components\widgets\ActiveForm;

/* @var $menus */

$this->title = Yii::t('module', 'Menu') . Yii::t('common', 'Sort Title');
?>
<?php $form = ActiveForm::begin(); ?>
<div class="widget-box  ui-sortable-handle">
    <div class="widget-body">
        <div class="widget-main">
            <div id="nestable" class="dd">
                <ol class="dd-list">
                    <?php $key = 1; foreach ($menus as  $val) : ?>
                        <li data-id="<?= $key; ?>" class="dd-item">
                            <div class="dd-handle">
                                <?= Html::hiddenInput("MENU[{$val['id']}][id]", $val['id']); ?>
                                <?= Html::encode($val['name']); ?>
                            </div>
                            <?php if (isset($val['items']) && $val['items']): ?>
                                <ol class="dd-list">
                                    <?php foreach ($val['items'] as $v) : $key ++; ?>
                                        <li class="dd-item item-red" data-id="<?= $key; ?>">
                                            <div class="dd-handle">
                                                <?= Html::hiddenInput("MENU[{$val['id']}][child][]",$v['id']); ?>
                                                <?= Html::encode($v['name']); ?>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ol>
                            <?php else : $key++; endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <?= Html::submitButton(Yii::t('common', 'Submit'), ['class' => 'btn btn-primary']); ?>
</div>
<?php $form::end(); ?>
<?php
$js = <<<EOD
    $('.dd').add('.myclass').nestable();
EOD;
$this->registerCssFile('css/sort.min.css', ['depends' => 'app\assets\AppAsset']);
$this->registerJsFile('js/jquery.nestable.min.js', ['depends' => 'app\assets\AppAsset']);
$this->registerJs($js);
?>
