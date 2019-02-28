<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%activity}}`.
 */
class m190227_132744_create_activity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%activity}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(150)->notNull(),
            'startDay' => $this->date()->notNull(),
            'endDay' => $this->date()->notNull(),
            'body' => $this->text(),
            'use_notification' => $this->boolean()->notNull()->defaultValue(0),
            'is_blocked'=> $this->boolean()->notNull()->defaultValue(0),
            'is_repeated' => $this->boolean()->notNull()->defaultValue(0),
            'date_created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->createTable('users',[
            'id'=>$this->primaryKey(),
            'email'=>$this->string(150)->notNull(),
            'password_hash'=>$this->string(300)->notNull(),
            'token'=>$this->string(150),
            'fio'=>$this->string(150),
            'date_create'=>$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%activity}}');
        $this->dropTable('users');
    }
}
