<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $email
 * @property string $password_hash
 * @property string $token
 * @property string $fio
 * @property string $date_create
 *
 * @property Activity[] $activities
 */
class Users extends UsersBase
{
    public $password;

    public function rules()
    {
        return array_merge([
            ['password','string','min'=>4]
        ],parent::rules());
    }
}
