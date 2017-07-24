<?php

namespace app\components\widgets;

use app\commands\SiteController;
use yii\base\Widget;
use yii\console\Exception;

/**
 * Class WebSocket
 * @package app\components\widgets
 */
class WebSocket extends Widget
{
    public $host = '127.0.0.1';
    public $port = 8080;
    public $log = true;
    public $eventClass;
    public $event = 'socketEvent';
    public $users;
    protected $socket;
    protected $sockets;

    /**
     * 运行socket
     */
    public function run()
    {
        $this->createSocket();
        $this->selectSocket();
        return $this;
    }

    /**
     * 检查服务启动系统
     * @throws Exception
     */
    protected function initCheck()
    {
        if(substr(php_sapi_name(), 0, 3) !== 'cli'){
            throw new Exception('请通过命令行模式运行!');
        }
    }

    /**
     * 创建 socket
     * @return resource
     */
    public function createSocket()
    {
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        socket_set_option($this->socket, SOL_SOCKET, SO_REUSEADDR, 1);
        socket_bind($this->socket, $this->host, $this->port);
        socket_listen($this->socket);

        $this->log('开始监听: ' . $this->host . ' : ' . $this->port);
    }

    /**
     * 监听
     */
    public function selectSocket()
    {
        $this->sockets = ['s' => $this->socket];
        while(true){
            // 阻塞用，有新连接时才会结束
            socket_select($this->sockets, $write = NULL, $except = NULL, NULL);
            foreach($this->sockets as $socket){
                // 客户连接socket
                if($socket == $this->socket){
                    // 如果请求来自监听端口那个套接字，则创建一个新的套接字用于通信
                    $client = socket_accept($this->socket);
                    $this->sockets[] = $client;
                    $user = array(
                        'socket' => $client,
                        'hand' => false,
                    );
                    $this->users[] = $user;
                    $key = $this->search($client);
                    $this->eventOutput('in', ['key' => $key]);
                }else{
                    //  没消息的socket就跳过
                    $len = socket_recv($socket, $message, 2048, 0);
                    $key = $this->search($socket);
                    if($len < 7){
                        $this->closeSocket($socket);
                        $this->eventOutput('out', ['key' => $key]);
                        continue;
                    }
                    // 没有握手进行握手
                    if(!$this->users[$key]['hand']){
                        $this->socketHandshake($key, $message);
                    }else{
                        $message = $this->messageUnCode($message);
                        $this->eventOutput('msg', ['key' => $key, 'socket' => $socket, 'message' => $message]);
                    }
                }
            }
        }
    }

    /**
     * 断开连接
     * @param $socket
     */
    public function closeSocket($socket)
    {
        $key = array_search($socket, $this->sockets);
        socket_close($socket);
        unset($this->sockets[$key]);
        unset($this->users[$key]);
    }

    /**
     * socket 握手
     * @param $key
     * @param $buffer
     */
    public function socketHandshake($key, $buffer)
    {
        $buf  = substr($buffer,strpos($buffer, 'Sec-WebSocket-Key:') + 18);
        $socketKey  = trim(substr($buf,0,strpos($buf, "\r\n")));
        $newKey = base64_encode(sha1($socketKey . "258EAFA5-E914-47DA-95CA-C5AB0DC85B11", true));
        $newMessage = "HTTP/1.1 101 Switching Protocols\r\n";
        $newMessage .= "Upgrade: websocket\r\n";
        $newMessage .= "Sec-WebSocket-Version: 13\r\n";
        $newMessage .= "Connection: Upgrade\r\n";
        $newMessage .= "Sec-WebSocket-Accept: " . $newKey . "\r\n\r\n";
        socket_write($this->users[$key]['socket'], $newMessage, strlen($newMessage));
        $this->users[$key]['hand']=true;
    }

    /**
     * 搜索
     * @param $socket
     * @return bool|int|string
     */
    public function search($socket)
    {
        foreach ($this->users as $key => $val){
            if($socket == $val['socket'])
                return $key;
        }
        return false;
    }

    /**
     * 发送消息
     * @param $socketId
     * @param $message
     * @return int
     */
    public function sendMessage($socketId, $message)
    {
        $message = $this->messageCode($message);
        return socket_write($socketId, $message, strlen($message));
    }

    /**
     * 字符串加密
     * @param $message
     * @return string
     */
    public function messageCode($message)
    {
        $message = preg_replace(array('/\r$/','/\n$/','/\r\n$/',), '', $message);
        $frame = [];
        $frame[0] = '81';
        $len = strlen($message);
        $frame[1] = $len <16 ? '0'. dechex($len): dechex($len);
        $frame[2] = $this->ordHex($message);
        $data = implode('', $frame);
        return pack("H*", $data);
    }

    /**
     * 字符串解密
     * @param $message
     * @return bool|string
     */
    public function messageUnCode($message)
    {
        $mask = array();
        $data = '';
        $msg = unpack('H*',$message);
        $head = substr($msg[1],0,2);
        if (hexdec($head{1}) === 8) {
            $data = false;
        }else if (hexdec($head{1}) === 1){
            $mask[] = hexdec(substr($msg[1],4,2));
            $mask[] = hexdec(substr($msg[1],6,2));
            $mask[] = hexdec(substr($msg[1],8,2));
            $mask[] = hexdec(substr($msg[1],10,2));
            $s = 12;
            $e = strlen($msg[1])-2;
            $n = 0;
            for ($i=$s; $i<= $e; $i+= 2) {
                $data .= chr($mask[$n%4]^hexdec(substr($msg[1],$i,2)));
                $n++;
            }
        }
        return $data;
    }

    /**
     * 字符串处理
     * @param $data
     * @return string
     */
    public function ordHex($data)
    {
        $message = '';
        $l = strlen($data);
        for ($i= 0; $i<$l; $i++) {
            $message .= dechex(ord($data{$i}));
        }
        return $message;
    }

    /**
     * 事件回调
     * @param $type
     * @param null $event
     * @return mixed
     */
    public function eventOutput($type, $event = null)
    {
        call_user_func([new $this->eventClass(), $this->event], $this, $type, $event);
    }

    /**
     * 输出日志
     * @param $message
     */
    public function log($message)
    {
        if($this->log){
            fwrite(STDOUT, iconv('utf-8', 'gbk//IGNORE', $message . "\r\n"));
        }
    }
}
