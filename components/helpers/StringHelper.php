<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 17/6/29
 * Time: 上午11:27
 */

namespace app\components\helpers;


class StringHelper
{
    /*
     * 出随机数
     * $randType
     */
    /**
     * 生成随机字符串
     * $randType为0-数字，1-大写英文字母，2-小写英文字母, null-什么都有
     * @param int $length
     * @param null $randType
     * @return string
     */
    public static function createRandom($length = 8, $randType = null)
    {
        $result = '';
        $str = array(
            array(48, 57),
            array(65, 90),
            array(97, 122),
        );
        for ($i = 0; $i < $length; $i++) {
            $row = $randType === null ? mt_rand(0, 2) : ($randType > 2 ? 2 : $randType);
            $result .= chr(mt_rand($str[$row][0], $str[$row][1]));
        }
        return $result;
    }
}