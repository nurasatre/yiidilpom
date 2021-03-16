<?php

use yii\db\Migration;

/**
 * Class m210316_120734_add_files
 */
class m210316_120734_add_files extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%files}}', ['title', 'author', 'description','loaded_at','updated_at'], [
            ['title 1', '1', 'description 1', '2021-03-15 17:00:00','2021-03-16 15:00:00'],
            ['title 2', '2', 'description 2', '2021-03-13 15:00:00','2021-03-14 16:00:00'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210316_120734_add_files cannot be reverted.\n";
        $this->delete('{{%files}}');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210316_120734_add_files cannot be reverted.\n";

        return false;
    }
    */
}
