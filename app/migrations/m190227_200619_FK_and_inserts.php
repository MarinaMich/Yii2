<?php

use yii\db\Migration;

/**
 * Class m190227_200619_FK_and_inserts
 */
class m190227_200619_FK_and_inserts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
    //добавление поля в таблицу    
        $this->addColumn('activity','user_id',$this->integer()->notNull());
    //создание связи один ко многим
        $this->addForeignKey('user_activity_FK',
            'activity','user_id',
            'users','id','CASCADE','CASCADE');

    //создание уникального поля
        $this->createIndex('asdf','users','email',true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    //перед удаление строки со связью нужно удалить FK    
        $this->dropForeignKey('user_activity_FK','activity');
    //удаление поля    
        $this->dropColumn('activity','user_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190227_200619_FK_and_inserts cannot be reverted.\n";

        return false;
    }
    */
}
