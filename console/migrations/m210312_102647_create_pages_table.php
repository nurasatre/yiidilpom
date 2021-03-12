<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pages}}`.
 */
class m210312_102647_create_pages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pages}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'content' => $this->text(),
            'created_at' => $this->datetime(),
        ]);
        
        $this->batchInsert('{{%pages}}', ['title', 'content', 'created_at'], [
            ['title 1', 'content 1', '2021-03-12 02:06:04'],
            ['title 2', 'content 2', '2021-03-11 01:06:08'],
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pages}}');
    }
}
