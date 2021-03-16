<?php

use yii\db\Migration;

/**
 * Class m210316_121252_add_comments
 */
class m210316_121252_add_comments extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%comments}}', ['comment_text', 'author', 'post_id','parent_id','data'], [
            ['comment 1', '1', '1', '1','2021-03-16 11:00:00'],
            ['comment 2', '2', '2', '2','2021-03-14 16:00:00'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210316_121252_add_comments cannot be reverted.\n";
        $this->delete('{{%comments}}');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210316_121252_add_comments cannot be reverted.\n";

        return false;
    }
    */
}
