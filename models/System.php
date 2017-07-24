<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 17/4/6
 * Time: 上午9:45
 */

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "{{%area}}".
 *
 * @property string $username
 * @property string $role
 * @property string $lastTime
 * @property string $lastIp
 * @property string $system
 * @property string $server
 * @property string $mysql
 * @property string $php
 * @property string $yii
 * @property string $upload
 */
class System extends Model
{
    public $username;
    public $role;
    public $lastTime;
    public $lastIp;
    public $system;
    public $server;
    public $mysql;
    public $php;
    public $yii;
    public $upload;

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => '账号',
            'role' => '角色',
            'lastTime' => '上次登录时间',
            'lastIp' => '上次登录IP ',
            'system' => '操作系统 ',
            'server' => '服务器软件 ',
            'mysql' => 'MySQL版本 ',
            'php' => 'PHP版本 ',
            'yii' => 'Yii版本 ',
            'upload' => '上传文件',
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        $session = Yii::$app->session;
        $lastAt = $session->get('admin_last_at');
        $lastIp = $session->get('admin_last_ip');
        $this->username = $session->get('admin_username');
        $this->role = $session->get('admin_role');
        $this->lastTime = $lastAt ? date('Y-m-d H:i:s', $lastAt) : '';
        $this->lastIp = $lastIp ? long2ip($lastIp): '';
        $system = explode(' ', php_uname());
        $this->system = $system[0] .' ' . ('/' == DIRECTORY_SEPARATOR ? $system[2] : $system[1]);
        $this->server = $_SERVER['SERVER_SOFTWARE'];
        $this->mysql = Yii::$app->db->createCommand('SELECT VERSION() AS `version`')->queryScalar();
        $this->php = 'PHP '. PHP_VERSION;
        $this->yii =  'Yii '. Yii::getVersion();
        $this->upload =  ini_get('upload_max_filesize');
    }
}