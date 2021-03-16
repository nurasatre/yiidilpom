<?php

use yii\db\Migration;

/**
 * Class m210315_141244_add_posts
 */
class m210315_141244_add_posts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%posts}}', ['title', 'content', 'author','category','tags','created_at','updated_at'], [
            ['title 1', 'content 1', 'author 1', 'category 1','tags 1', '2021-03-13 12:15:16', '2021-03-15 17:00:00'],
            ['title 2', 'content 2', 'author 2', 'category 2','tags 2', '2021-03-10 12:15:16', '2021-03-12 17:00:00'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210315_141244_add_posts cannot be reverted.\n";
        $this->delete('{{%posts}}');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210315_141244_add_posts cannot be reverted.\n";

        return false;
    }
    */
}
