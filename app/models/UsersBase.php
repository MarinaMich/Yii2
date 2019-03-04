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
class UsersBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password_hash'], 'required'],
            //safe - означает, что поле безопасно и проверяться не будет
            [['date_create'], 'safe'],
            [['email', 'token', 'fio'], 'string', 'max' => 150],
            [['password_hash'], 'string', 'max' => 300],
            //unique - поле уникальное
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        //Yii::t - для мультиязычности
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'token' => Yii::t('app', 'Token'),
            'fio' => Yii::t('app', 'Fio'),
            'date_create' => Yii::t('app', 'Date Create'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivities()
    {
        //один ко многим между таблицами
        return $this->hasMany(Activity::className(), ['user_id' => 'id']);
    }
}
