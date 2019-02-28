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
    public function createNewUser(&$model):bool{
        if(!$model->validate(['password','email'])){
            return false;
        }

        $model->password_hash=$this->hashPassword($model->password);

//        if(!$model->validate()){
//            return false;
//        }

        if($model->save()){
            return true;
        }

        return false;
    }

    private function hashPassword($password){
        return \Yii::$app->security->generatePasswordHash($password);
    }
}