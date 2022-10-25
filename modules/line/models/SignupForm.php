<?php
// namespace app\models;
namespace app\modules\line\models;

use Yii;
use yii\helpers\ArrayHelper;

// use app\models\SignupForm;
use yii\base\Model;
use app\modules\usermanager\models\User;
use yii\db\ActiveRecord;
/**
 * Signup form
 */
class SignupForm extends Model
{

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    public $username;
    public $fullname;
    public $password;
    public $confirm_password;
    public $roles;
    public $q;
    public $status;
    public $email;
    public $mobile;
    public $gender;
    public $nationality;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => 'app\modules\usermanager\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => 'app\modules\usermanager\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['mobile', 'required'],
            ['gender', 'required'],
            ['nationality', 'required'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        // return $this->validate();
        // if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            // $user->phone = $this->mobile;
            // $user->gender = $this->gender;
            // $user->nationality = $this->nationality;
            // var_dump($this->nationality);
            // die();
            $user->generateAuthKey();

            
            if ($user->save(false)) {
                return $user;
            }
        // }

        // return null;
    }

    public function getItemStatus() {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_DELETED => 'Deleted'
        ];
    }

    public function getStatusName() {
        $items = $this->getItemStatus();
        return array_key_exists($this->status, $items) ? $items[$this->status] : '';
    }

    public function getAllRoles() {
        $auth = $auth = Yii::$app->authManager;
        return ArrayHelper::map($auth->getRoles(), 'name', 'name');
    }

}