<?php
/**
 * Created by PhpStorm.
 * User: win
 * Date: 2017/11/26
 * Time: 23:13
 */

namespace app\models\forms;

use app\models\User;
use yii\base\Model;

/**
 * Class UpdateUserForm
 * @package app\models\forms
 * @property User $user
 */
class UpdateUserForm extends Model
{
    public $username;
    public $email;
    public $status;
    public $password;

    /**
     * @var User
     */
    protected $_user;

    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => 'app\models\User', 'filter' => ['not in', 'id', $this->_user->id], 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'filter' => ['not in', 'id', $this->_user->id], 'message' => 'This email address has already been taken.'],

            ['password', 'string', 'min' => 6, 'skipOnEmpty' => true],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'password' => '密码',
            'email' => 'Email',
            'status' => '状态',
        ];
    }

    public function init()
    {
        parent::init();
        $this->username = $this->_user->username;
        $this->email = $this->_user->email;
        $this->status = $this->_user->status;
    }

    public function setUser($value)
    {
        $this->_user = $value;
    }

    public function getUser()
    {
        return $this->_user;
    }

    public function save()
    {
        if ($this->validate()) {
            $this->_user->username = $this->username;
            $this->_user->email = $this->email;
            $this->_user->status = $this->status;
            if ($this->password) {
                $this->_user->setPassword($this->password);
            }
            return $this->_user->save();
        }
        return false;
    }
}