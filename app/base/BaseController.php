<?php
namespace app\base;

use yii\web\Controller;

class BaseController extends Controller
{
	public function beforeAction($action)
	{
	return parent::beforeAction($action);
	}
	
	public function afterAction($action, $result)
	{
		$session = \Yii::$app->session;
		$session->setFlash('lastPage', \Yii::$app->request->absoluteUrl);
		return parent::afterAction($action, $result);
	}
} 