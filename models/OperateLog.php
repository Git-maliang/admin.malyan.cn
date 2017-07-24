<?php

namespace app\models;

use Yii;
use app\components\events\OperateLogEvent;
/**
 * This is the model class for table "{{%operate_log}}".
 *
 * @property integer $id
 * @property integer $operate_id
 * @property integer $type
 * @property integer $module
 * @property string $describe
 * @property integer $admin_id
 * @property integer $ip
 * @property integer $created_at
 */
class OperateLog extends \yii\db\ActiveRecord
{
    /**
     * 操作类型
     */
    const EVENT_TYPE_CREATE = 1; // 创建
    const EVENT_TYPE_UPDATE = 2; // 更新
    const EVENT_TYPE_DELETE = 3; // 删除
    const EVENT_TYPE_AUTH = 4; // 授权
    const EVENT_TYPE_DISABLE =5; // 禁用
    const EVENT_TYPE_ENABLE = 6; // 启用
    const EVENT_TYPE_SORT = 7; // 排序

    /**
     * 操作模块
     */
    const EVENT_MODULE_ADMIN = 1; // 管理员信息
    const EVENT_MODULE_ROLE = 2; // 角色管理
    const EVENT_MODULE_PERMISSION = 3; // 权限管理
    const EVENT_MODULE_MENU = 4; // 菜单管理

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%operate_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['operate_id', 'type', 'module', 'admin_id', 'ip', 'created_at'], 'integer'],
            [['describe'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '自增',
            'operate_id' => '操作ID',
            'type' => '操作类型',
            'module' => '操作模块',
            'describe' => '操作描述',
            'admin_id' => '操作人',
            'ip' => 'IP',
            'created_at' => '创建时间',
        ];
    }

    /**
     * 操作类型
     * @return array
     */
    public static function typeArray()
    {
        return [
            self::EVENT_TYPE_CREATE => Yii::t('common', 'Create Title'),
            self::EVENT_TYPE_UPDATE => Yii::t('common', 'Update Title'),
            self::EVENT_TYPE_DELETE => Yii::t('common', 'Delete Title'),
            self::EVENT_TYPE_AUTH => Yii::t('common', 'Auth Title'),
            self::EVENT_TYPE_DISABLE => Yii::t('common', 'Disable Title'),
            self::EVENT_TYPE_ENABLE => Yii::t('common', 'Enable Title'),
            self::EVENT_TYPE_SORT => Yii::t('common', 'Sort Title'),
        ];
    }

    /**
     * 操作模块
     * @return array
     */
    public static function moduleArray()
    {
        return [
            self::EVENT_MODULE_ADMIN => '管理员信息',
            self::EVENT_MODULE_MENU => '菜单管理',
            self::EVENT_MODULE_ROLE => '角色管理',
            self::EVENT_MODULE_PERMISSION => '权限管理',
        ];
    }

    /**
     * 操作日志记录
     * @param OperateLogEvent $event
     */
    public static function record(OperateLogEvent $event)
    {
        try{
            $model = new OperateLog();
            $model->operate_id = $event->operateId;
            $model->type = $event->operateType;
            $model->module = $event->operateModule;
            $model->describe = $event->operateDescribe;
            $model->admin_id = Yii::$app->user->id;
            $model->ip = ip2long(Yii::$app->request->userIP);
            $model->created_at = time();
            if($model->validate()){
                $model->save();
            }
        }catch (\Exception $e){
            Yii::info('Operate log record failure');
        }
    }
}
