<?php

namespace app\commands;

use app\components\widgets\WebSocket;

class SiteController extends Controller
{
    /**
     * socket服务
     * @throws \Exception
     */
    public function actionService()
    {
        WebSocket::widget(['eventClass' => 'app\components\events\WebSocketEvent']);
    }
}
