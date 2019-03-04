<?php
/**
 * Created by PhpStorm.
 * User: Talisman
 * Date: 28.02.2019
 * Time: 20:27
 */

namespace app\controllers;


use yii\web\Controller;

class RbacController extends Controller
{
	//формирует правило
    public function actionGen(){
        \Yii::$app->rbac->generateRbacRules();
    }
}