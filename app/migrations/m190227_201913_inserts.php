<?php

use yii\db\Migration;

/**
 * Class m190227_201913_inserts
 */
class m190227_201913_inserts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //заполняем данными поля пользователей
        $this->insert('users',['id'=>1,'email'=>'email@email.ru','password_hash'=>'1111',
            'fio'=>'Иванов Иван Иванович']);
        $this->insert('users',['id'=>2,'email'=>'email2@email.ru','password_hash'=>'1111',
            'fio'=>'Петров Петр Петрович']);

//заполняем данными поля таблицы активности
        $this->batchInsert('activity',[
            'title','startDay','endDay','user_id','use_notification'
        ],[
            ['Заголовк 1',date('Y-m-d'),date('Y-m-d'),1,0],
            ['Заголовк 1_1',date('Y-m-d'),date('Y-m-d'),1,0],
            ['Заголовк 1_2','2018-12-12','2019-01-01',1,0],
            ['Заголовк 1_3',date('Y-m-d'),date('Y-m-d'),1,1],
            ['Заголовк 2','2018-12-12','2018-12-29',2,0],
            ['Заголовк 2_2',date('Y-m-d'),date('Y-m-d'),1,1]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190227_201913_inserts cannot be reverted.\n";

        return false;
    }
    */
}
