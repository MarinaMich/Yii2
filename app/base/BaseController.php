<?php

namespace app\base;

use yii\web\Controller;
use yii\web\HttpException;

class BaseController extends Controller
{
    public function beforeAction($action)
    {
        if(\Yii::$app->user->isGuest){
            throw new HttpException(401,'Not access');
        }
        return parent::beforeAction($action);
    }

    public function afterAction($action, $result)
    {
        $session = \Yii::$app->session;
        $session->setFlash('lastPage', \Yii::$app->request->absoluteUrl);
        return parent::afterAction($action, $result);
    }
} 