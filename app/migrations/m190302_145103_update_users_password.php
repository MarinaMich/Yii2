<?php

use yii\db\Migration;
use yii\base\Security;

/**
 * Class m190302_145103_update_users_password
 */
class m190302_145103_update_users_password extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->update('users',  
            [
                'email' => 'email@email.ru',
                'password_hash' => \Yii::$app->security->generatePasswordHash('123456')
            ],
            ['id' => 1]);
        $this->update('users',  
            [
                'email' => 'email2@email.ru',
                'password_hash' => \Yii::$app->security->generatePasswordHash('123456')
            ],
            ['id' => 2]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190302_145103_update_users_password cannot be reverted.\n";

        return false;
    }
    */
}
