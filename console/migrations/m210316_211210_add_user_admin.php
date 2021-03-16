<?php

use yii\db\Migration;

/**
 * Class m210316_211210_add_user_admin
 */
class m210316_211210_add_user_admin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $time = time();

        $this->batchInsert(
            '{{%user}}', 
            array( 
                'username',
                'auth_key',
                'password_hash',
                'email',
                'status',
                'created_at',
                'updated_at'
            ), 
            array( 
                array( 
                    'admin', 
                    'IJ1uLCmrAn8NnOIF_K5j_lWUDCVJL_MY',
                    '$2y$13$YLvRS.31Ti1/FPTLBXDHqu.qgxBkhihp1IlAo/jVp1kmimm.MZfuC',
                    'adminyiidiplom@gmail.com',
                    10,
                    $time,
                    $time
                ),
            )
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%user}}', ['username' => 'admin']);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210316_211210_add_user_admin cannot be reverted.\n";

        return false;
    }
    */
}
