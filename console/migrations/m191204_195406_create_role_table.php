<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%role}}`.
 */
class m191204_195406_create_role_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%role}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string() ->notNull(),
            'description' => $this-> string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%role}}');
    }
}
