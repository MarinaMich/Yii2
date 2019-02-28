<?php

namespace app\controllers;


use app\base\BaseController;
use app\components\DAOComponent;

class DaoController extends BaseController
{
    public function actionTest(){

        /** @var DAOComponent $dao */
        $dao=\Yii::$app->dao;

        $dao->insertTest();

        $users=$dao->getAllUsers();
        $activityUser=$dao->getActivityUser();

        $firstAcitvity=$dao->getFirstActivity();
        $countNotif=$dao->countNotificationActivity();

        $allActivityUser=$dao->getAllActivityUser(1);
        $activityReader=$dao->getActivityReader();

        return $this->render('test',['users'=>$users,'activityUser'=>$activityUser,
            'firstActivity'=>$firstAcitvity,'count_notif'=>$countNotif,
            'allActivityUser'=>$allActivityUser,'activityReader'=>$activityReader]);
    }
}