<?php

use yii\bootstrap\Html;
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
    <style>
        .barrage .screen{width:100%;height:100%;position:absolute;top:0px;right:0px;}
        .barrage .screen .s_close{z-index:2;top:20px;right:20px;position:absolute;text-decoration:none;width:40px;height:40px;border-radius:20px;text-align:center;color:#fff;background:#000;line-height:40px;}
        .barrage .screen .mask{position:relative;width:100%;height:100%;background:#000;opacity:0.5;filter:alpha(opacity:1);z-index:1;}
        .barrage{width:100%;height:100%;}
        .barrage .screen .mask div{position:absolute;font-size:20px;font-weight:bold;white-space:nowrap;line-height:40px;z-index:40;}
        .barrage .send{z-index:1;width:100%;height:55px;background:#000;position:absolute;bottom:0px;text-align:center;}
        .barrage .send .s_text{width:600px;height:40px;line-height:10px;font-size:20px;font-family:"微软雅黑";}
        .barrage .send .s_btn{width:105px;height:40px;background:#22B14C;color:#fff;}
    </style>
    <?php $this->head(); ?>
</head>
<?php $this->beginBody(); ?>
<body>
<div class="barrage">
    <div class="screen">
        <div class="mask">
            <!--内容在这里显示-->
        </div>
    </div>
    <!--Send Begin-->
    <div class="send" style="color: #ffffff;">
        <input type="text" class="s_text"/>
        <input type="button" class="s_btn" value="说两句"/> （按Enter发送）
    </div>
    <!--Send End-->
</div>
<?php
\yii\web\JqueryAsset::register($this);
$js = <<<EOD
    //提交评论
    function button(text){
        if(text == ""){
            return;
        }
        var _lable = $("<div style='right:20px;top:0px;opacity:1;color:"+getRandomColor()+";'>"+text+"</div>");
        $(".mask").append(_lable.show());
        init_barrage();
    }

    //初始化弹幕技术
    function init_barrage(){
        var _top = 0;
        $(".mask div").show().each(function(){
            var _left = $(window).width()-$(this).width();//浏览器最大宽度，作为定位left的值
            var _height = $(window).height();//浏览器最大高度
            _top +=75;
            if(_top >= (_height -130)){
                _top = 0;
            }
            $(this).css({left:_left,top:_top,color:getRandomColor()});

            //定时弹出文字
            var time = 10000;
            if($(this).index() % 2 == 0){
                time = 15000;
            }
            $(this).animate({left:"-"+_left+"px"},time,function(){
                $(this).remove();
            });

        });
    }

    //获取随机颜色
    function getRandomColor(){
        return '#' + (function(h){
                return new Array(7 - h.length).join("0") + h
            })((Math.random() * 0x1000000 << 0).toString(16))
    }

    function link(){
        var url='ws://127.0.0.1:8080';
        socket = new WebSocket(url);
        socket.onopen = function(){
            button("欢迎！");
        };
        socket.onmessage = function(msg){
            button(msg.data);console.log(msg.data);
        };
        socket.onclose = function(){
            log('断开连接');
        };
    }

    function dis(){
        socket.close();
        socket=null;
    }

    function log(var1){
        $('.log').append(var1+"\\r\\n");
    }

    $('.s_btn').click(function(){
        send();
    });

    $('.s_btn').click(function(){
        msg = $('.s_text').val();
        if(msg == ""){
            return false;
        }
        $(".s_text").val('');
        socket.send(msg);
    });

    $("body").keydown(function(event) {
        if(event.keyCode == "13") {
            send();
        }
    });

    function send(){
        msg = $('.s_text').val();
        if(msg == ""){
            return false;
        }
        $(".s_text").val('');
        socket.send(msg);
    }

    function send2(){
        var json = JSON.stringify({'type':'php','msg':$('#text2').attr('value')});
        socket.send(json);
    }
    link();
EOD;
$this->registerJs($js);
?>
</body>
<?php $this->endBody(); ?>
</html>
<?php $this->endPage(); ?>

