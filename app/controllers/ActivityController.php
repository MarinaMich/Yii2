<?php

namespace app\controllers;

use app\base\BaseController;
use app\components\ActivityComponent;
use app\controllers\actions\ActivityCreateAction;
use yii\web\Controller;
use yii\web\HttpException;

class ActivityController extends BaseController
{
    public function actions()
    {

        return [
            'create' => ['class' => ActivityCreateAction::class]
        ];

    }

//форма просмотра события
    public function actionView($id)
    {
        /** @var ActivityComponent $comp */
        $comp = \Yii::$app->activity;

        $acitivty = $comp->getActivity($id);
        if (!$acitivty) {
            throw new HttpException(401, 'Activity not found');
        }

        if (!\Yii::$app->rbac->canViewEditAll()) {
            if (!\Yii::$app->rbac->canViewActivity($acitivty)) {
                throw new HttpException(403, 'not access view this activity');
            }
        }

        return $this->render('create-derivation', ['activity' => $acitivty]);
    }
} 