<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%student}}`.
 */
class m201128_134643_create_student_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%student}}', [
            'id' => $this->primaryKey(),
            'fname' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'sname' => $this->string()->Null(),
            'group_id' =>  $this->integer()->notNull(),
            'photo' =>  $this->string(250)->notNull(),
        ]);

        $this->createIndex(
            'idx-student-group_id',
            'student',
            'group_id'
        );

        $this->addForeignKey(
            'fk-student-group_id',
            'student',
            'group_id',
            'group',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-student-group_id','student');
        $this->dropTable('{{%student}}');
    }
}
