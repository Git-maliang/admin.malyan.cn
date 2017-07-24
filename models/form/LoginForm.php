<?php

namespace app\models\form;

use Yii;
use yii\base\Model;
use app\models\Admin;

/**
 * LoginForm is the model behind the login form.
 *
 * @property Admin|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $verifyCode;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'verifyCode'], 'required', 'message' => '{attribute}不能为空。'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha', 'message' => '{attribute}错误。'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'password' => '密码',
            'verifyCode' => '验证码',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, '用户名或密码错误。');
            }

            if(!$user || $user->status !== Admin::STATUS_ACTIVE){
                $this->addError($attribute, '此用户已被禁用。');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $result = Yii::$app->user->login($this->getUser(), Yii::$app->user->authTimeout);
            if($result === false){
                Yii::$app->getSession()->setFlash('error', '登录失败');
            }
            return $result;
        }else{
            $firstErrors = $this->firstErrors;
            Yii::$app->getSession()->setFlash('warning', current($firstErrors));
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return Admin|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Admin::findByUsername($this->username);
        }

        return $this->_user;
    }
}
