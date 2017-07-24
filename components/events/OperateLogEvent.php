<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 17/6/26
 * Time: 下午4:45
 */

namespace app\components\events;


use yii\base\Event;

/**
 * Class OperateLogEvent
 * @package app\components\events
 *
 * @property integer $operateId
 * @property integer $operateType
 * @property integer $operateModule
 * @property string $operateDescribe
 */
class OperateLogEvent extends Event
{
    /**
     * 事件名称
     * @var string
     */
    const EVENT_NAME = 'operate-log';

    /**
     * 操作id
     * @var int
     */
    public $operateId;

    /**
     * 操作类型
     * 取值范围：EVENT_TYPE_XXX
     * @var int
     */
    public $operateType;

    /**
     * 操作模块ID
     * 取值范围: EVENT_MODULE_XXX
     * @var int
     */
    public $operateModule;

    /**
     * 操作模块描述
     * @var string
     */
    public $operateDescribe;
}