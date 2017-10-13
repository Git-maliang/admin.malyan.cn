<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 17/10/12
 * Time: 下午1:37
 */

namespace app\components\helpers;

use crazyfd\qiniu\Qiniu;

class UploadHelper
{
    /**
     * 七牛云上传
     * @param $filePath
     * @param $extension
     * @return string
     * @throws \yii\web\HttpException
     */
    public static function qnUpload($filePath, $extension = 'jpg')
    {
        $accessKey = 'n-K0BplUXED8juHWjXm4oLbWx3UlppUraYwaDIgR';
        $secretKey = 'sET-cgQCg4A6om1zuXV9f0i2MTLptuo1IyW4HJPC';
        $domain = 'http://img.malyan.cn/';
        $bucket = 'malyan';
        $qiNiu = new Qiniu($accessKey, $secretKey, $domain, $bucket);
        $key = date('YmdHis') . '.' . $extension;
        $qiNiu->uploadFile($filePath, $key);
        return $qiNiu->getLink($key);
    }

    public static function qnDelete($filename)
    {
        $accessKey = 'n-K0BplUXED8juHWjXm4oLbWx3UlppUraYwaDIgR';
        $secretKey = 'sET-cgQCg4A6om1zuXV9f0i2MTLptuo1IyW4HJPC';
        $domain = 'http://img.malyan.cn/';
        $bucket = 'malyan';
        $qiNiu = new Qiniu($accessKey, $secretKey, $domain, $bucket);
        return $qiNiu->delete($filename);
    }
}