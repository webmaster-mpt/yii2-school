<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%predmet}}`.
 */
class m201106_072657_create_predmet_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%predmet}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%predmet}}');
    }
}
