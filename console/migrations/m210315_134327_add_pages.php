<?php

use yii\db\Migration;

/**
 * Class m210315_134327_add_pages
 */
class m210315_134327_add_pages extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
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
        echo "m210315_134327_add_pages cannot be reverted.\n";
        $this->delete('{{%pages}}');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210315_134327_add_pages cannot be reverted.\n";

        return false;
    }
    */
}
