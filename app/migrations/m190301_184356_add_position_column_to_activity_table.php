<?php

use yii\db\Migration;

/**
 * Handles adding position to table `{{%activity}}`.
 */
class m190301_184356_add_position_column_to_activity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%activity}}', 'email', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%activity}}', 'email');
    }
}
