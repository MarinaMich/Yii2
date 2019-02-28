<?php

namespace app\components;


use yii\base\Component;
use yii\db\conditions\InCondition;
use yii\db\Query;
use yii\log\Logger;

class DAOComponent extends Component
{
    /**
     * @return \yii\db\Connection
     */
    public function getDb(){
        return \Yii::$app->db;
    }

    public function getAllUsers(){
        $sql='select * from users';

        return $this->getDb()->createCommand($sql)->queryAll();
    }
//все активности конкретного пользователя
    public function getActivityUser($id=2){
        //безопасный параметризированный запрос, :user - параметр
        $sql='select * from activity where user_id=:user';
        return $this->getDb()->createCommand($sql,[':user'=>(int)$id])->queryAll();
    }
// вернёт одну строку
    public function getFirstActivity(){
        $sql='select * from activity';
        return $this->getDb()->createCommand($sql)->queryOne();
    }
// вернёт скалярное значение
    //кол-во активностей с уведомлениями
    public function countNotificationActivity(){
        $sql='select count(id) from activity where use_notification=1';

        return $this->getDb()->createCommand($sql)->queryScalar();
    }

//список активностей пользователя и его email
    public function getAllActivityUser($id_user){
        $query=new Query();

        return $query->select(['title','startDay','endDay','email'])
            ->from('activity a')
            ->innerJoin('users u','a.user_id=u.id')
            ->andWhere(['a.user_id'=>$id_user])
            ->andWhere('a.date_created<=:date',[':date' => date('Y-m-d')])
            ->orderBy(['a.id'=>SORT_DESC])
            ->limit(10)
            ->all();
    }
/*
 //формирование запроса 
     public function getAllActivityUser($id_user){
        $query=new Query();

        return $query->select(['title','timeStart','email'])
            ->from('activity a')
            ->innerJoin('users u','a.user_id=u.id')
            ->andWhere(['a.user_id'=>$id_user])
//запрос для нетипичных операторов            
//            ->andWhere(new InCondition('user_id','in',[]))
            ->andWhere('a.date_created<=:date',[':date' => date('Y-m-d H:i:s')])
            ->orderBy(['a.id'=>SORT_DESC])
            ->limit(10)
            ->createCommand()->rawSql;
    }   */

//БД получает запрос на большой объем данных, но получаем их по одному
    public function getActivityReader(){
        $sql='select * from activity';

        return $this->getDb()->createCommand($sql)->query();
    }

//транзакция
    public function insertTest(){
        //открыли транзакцию
        $trans=$this->getDb()->beginTransaction();
        try{
            //добавляем позиции
            $this->getDb()->createCommand()->insert('activity',[
                'user_id'=>2,
                'title'=>'title1',
                'startDay'=>date('Y-m-d'),
                'endDay'=>date('Y-m-d')
            ])->execute();
 //пункт 1 выполнился, ошибка, полный откат транзакции, ни чего не добавится          
//            throw new \Exception('test');

            $this->getDb()->createCommand()->insert('activity',[
                'user_id'=>2,
                'title'=>'title2',
                'startDay'=>date('Y-m-d'),
                'endDay'=>date('Y-m-d')
            //все запросы кроме select делаем через  execute  
            ])->execute();

            $trans->commit();
        }catch (\Exception $e){ //откат транзакции в случае ошибки
            \Yii::getLogger()->log($e->getMessage(),Logger::LEVEL_ERROR);
            $trans->rollBack();
        }

//еще вариант транзакции
//        $this->getDb()->transaction(function (){
//
//        });
    }
}