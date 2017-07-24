<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 17/6/19
 * Time: 下午3:37
 */

namespace app\components\captcha;

use Yii;
use yii\helpers\Url;
use yii\web\Response;

class CaptchaAction extends \yii\captcha\CaptchaAction
{
    /**
     * @var int the width of the generated CAPTCHA image. Defaults to 120.
     */
    public $width = 80;
    /**
     * @var int the height of the generated CAPTCHA image. Defaults to 50.
     */
    public $height = 32;
    /**
     * @var int padding around the text. Defaults to 2.
     */
    public $backColor = 0xFFEBCD;
    /**
     * @var int the font color. For example, 0x55FF00. Defaults to 0x2040A0 (blue color).
     */
    public $foreColor = 0xFFA500;
    /**
     * @var int the minimum length for randomly generated word. Defaults to 6.
     */
    public $minLength = 4;
    /**
     * @var int the maximum length for randomly generated word. Defaults to 7.
     */
    public $maxLength = 4;
    /**
     * @var int the offset between characters. Defaults to -2. You can adjust this property
     * in order to decrease or increase the readability of the captcha.
     */
    public $offset = 3;

    /**
     * Runs the action.
     */
    public function run()
    {
        if (Yii::$app->request->getQueryParam(self::REFRESH_GET_VAR) !== null) {
            // AJAX request for regenerating code
            $code = $this->getVerifyCode(true);
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'hash1' => $this->generateValidationHash($code),
                'hash2' => $this->generateValidationHash(strtolower($code)),
                // we add a random 'v' parameter so that FireFox can refresh the image
                // when src attribute of image tag is changed
                'url' => Url::to([$this->id, 'v' => uniqid()]),
            ];
        } else {
            $this->setHttpHeaders();
            Yii::$app->response->format = Response::FORMAT_RAW;
            return $this->renderImage($this->getVerifyCode(true));
        }
    }
}