<?php
/**
 * Created by PhpStorm.
 * User: Talisman
 * Date: 28.02.2019
 * Time: 20:26
 */

namespace app\components;


use app\rules\ViewActivityOwnerRule;
use yii\base\Component;

class RbacComponent extends Component
{
    /**
     * @return \yii\rbac\ManagerInterface
     */
    public function getAuthManager(){
        return \Yii::$app->authManager;
    }

    public function generateRbacRules(){
        $authManager=$this->getAuthManager();

        $authManager->removeAll();

        $admin=$authManager->createRole('admin');
        $user=$authManager->createRole('user');

        $authManager->add($admin);
        $authManager->add($user);

        $createActivity=$authManager->createPermission('createActivity');
        $createActivity->description='Создание активности';

        $viewOwnerRule=new ViewActivityOwnerRule();
        $authManager->add($viewOwnerRule);


        $viewActivity=$authManager->createPermission('viewActivity');
        $viewActivity->description='Просмотр активности';
        $viewActivity->ruleName=$viewOwnerRule->name;

        $viewEditAll=$authManager->createPermission('viewEditAll');
        $viewEditAll->description='Просмотр и редактирование всех активностей';

        $authManager->add($createActivity);
        $authManager->add($viewActivity);
        $authManager->add($viewEditAll);

        $authManager->addChild($user,$createActivity);
        $authManager->addChild($user,$viewActivity);

        $authManager->addChild($admin,$user);
        $authManager->addChild($admin,$viewEditAll);

        $authManager->assign($user,3);
        $authManager->assign($admin,4);
    }

    /**
     * @return bool
     */
    public function canCreateActivity(){
        return \Yii::$app->user->can('createActivity');
    }

    public function canViewEditAll(){
        return \Yii::$app->user->can('viewEditAll');
    }

    public function canViewActivity($activity):bool{
        return \Yii::$app->user->can('viewActivity',['activity'=>$activity]);
    }
}