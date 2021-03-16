<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%files}}`.
 */
class m210315_181717_create_files_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%files}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'author' => $this->integer(),
            'description' => $this->string(),
            'loaded_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%files}}');
    }
}
