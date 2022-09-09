<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%prepod}}`.
 */
class m201106_073039_create_prepod_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%prepod}}', [
            'id' => $this->primaryKey(),
            'fname' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'sname' => $this->string()->Null(),
            'predmet_id' => $this->integer()->notNull(),
        ]);
        $this->createIndex(
            'idx-prepod-predmet_id',
            'prepod',
            'predmet_id'
        );

        $this->addForeignKey(
            'fk-prepod-predmet_id',
            'prepod',
            'predmet_id',
            'predmet',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-prepod-predmet_id','prepod');
        $this->dropTable('{{%prepod}}');
    }
}
