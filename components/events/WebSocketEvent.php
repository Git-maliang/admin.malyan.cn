<?php

namespace app\components\events;

use Yii;
use yii\base\Event;
use yii\helpers\ArrayHelper;
use app\components\widgets\WebSocket;

class WebSocketEvent extends Event
{
    public $users;

    /**
     * @var WebSocket
     */
    public $webSocket = null;

    /**
     * socket 回调
     * @param $webSocket
     * @param $type
     * @param $event
     * @return mixed
     */
    public function socketEvent($webSocket, $type, $event)
    {
        if($this->webSocket === null){
            $this->webSocket = $webSocket;
        }
        if('in' == $type){
            // 客户进入
            $this->webSocket->log('客户进入:' . $event['key']);
        }elseif('out' == $type){
            // 客户退出
            $this->webSocket->log('客户退出:' . $event['key']);
        }elseif('msg' == $type){
            // 发送消息
            $this->sendAllUsers($event['message']);
            $this->roboot($event['socket'], $event['message']);

            $this->webSocket->log('客户(' . $event['key'] . ')消息:' . $event['message']);
        }
    }

    /**
     * 发送消息给全部用户
     * @param $users
     * @param $message
     */
    public function sendAllUsers($message)
    {
        foreach($this->webSocket->users as $user){
            $this->webSocket->sendMessage($user['socket'], $message);
        }
    }

    /**
     * 机器人
     * @param $socketId
     * @param $message
     * @return bool
     */
    protected function roBoot($socketId, $message)
    {
        switch ($message)
        {
            case 'hello':
                $message = $socketId;
                break;
            case 'name':
                $message = '机器人';
                break;
            case 'time':
                $message = '当前时间:' . date('Y-m-d H:i:s');
                break;
            case '再见':
                $this->webSocket->sendMessage($socketId, '( ^_^ )/~~拜拜');
                $this->webSocket->closeSocket($socketId);
                return false;
                break;
            case '天王盖地虎':
                $array = ['小鸡炖蘑菇','宝塔震河妖','粒粒皆辛苦'];
                $message = $array[rand(0,2)];
                break;
            default:
                $message = '( ⊙o⊙?)不懂,你可以尝试说:hello,name,time,再见,天王盖地虎.';
        }
        $this->webSocket->sendMessage($socketId, $message);
    }

}