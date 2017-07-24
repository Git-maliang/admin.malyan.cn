<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 17/6/28
 * Time: 下午5:26
 */

namespace app\components\helpers;


class MatchHelper
{
    public static $mobile =  '/^13[0-9]{9}$|15[0-9]{9}$|18[0-9]{9}$|14[579][0-9]{8}$|17[013678][0-9]{8}$/';
    public static $chinese =  '/^[\x{4e00}-\x{9fa5}]+$/u';
    public static $password =  '/^[a-zA-Z0-9]+$/u';
}