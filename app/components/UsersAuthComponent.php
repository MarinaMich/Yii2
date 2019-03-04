<?php
/**
 * Created by PhpStorm.
 * User: Talisman
 * Date: 28.02.2019
 * Time: 19:22
 */

namespace app\components;


use app\models\Users;
use yii\base\Component;

//авторизация
class UsersAuthComponent extends Component
{
    /**
     * @param null $params
     * @return Users
     */
    public function getModel($params=null){
        $model= new Users();
        if($params){
            $model->load($params);
        }

        return $model;
    }

    /**
     * @param $model Users
     * @return bool
     */
    //авторизация
    public function loginUser(&$model):bool{
        $user=$this->getUserByEmail($model->email);
        if(!$user){
            $model->addError('email','Пользователя не существует');
            return false;
        }

        if(!$this->validatePassword($model->password,$user->password_hash)){
            $model->addError('password','Пароль неверный');
            return false;
        }
        //переопределяем атрибут
        $user->username=$user->email;

        return \Yii::$app->user->login($user);
    }

    /**
     * @param $password
     * @param $hash
     * @return bool
     */
    //проверка пароля
    private function validatePassword($password,$hash){
        return \Yii::$app->security->validatePassword($password,$hash);
    }

    /**
     * @param $email
     * @return Users|array|\yii\db\ActiveRecord
     */
    //проверка email
    public function getUserByEmail($email){
        return $this->getModel()::find()->andWhere(['email'=>$email])->one();
    }

//    public

    /**
     * @param $model Users
     * @return bool
     */
    public function createNewUser(&$model):bool{
        if(!$model->validate(['password','email'])){
            return false;
        }
//присваиваем hash паролю, введенному пользователем
        $model->password_hash=$this->hashPassword($model->password);
// проверка на условия rules(), в этом случае не обязательна, так как save() вызовит validate() 
//        if(!$model->validate()){
//            return false;
//        }
//отправка в БД, save() возвращает или true, или false
        if($model->save()){
            return true;
        }

        return false;
    }

//шифруем пароль
    private function hashPassword($password){
        return \Yii::$app->security->generatePasswordHash($password);
    }
}