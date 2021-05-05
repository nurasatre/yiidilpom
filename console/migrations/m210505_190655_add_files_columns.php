<?php

use yii\db\Migration;

/**
 * Class m210505_190655_add_files_columns
 */
class m210505_190655_add_files_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn( 'files', 'url', $this->string() );
        $this->addColumn( 'files', 'mime_type', $this->string() );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn( 'files', 'url' );
        $this->dropColumn( 'files', 'mime_type' );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210505_190655_add_files_columns cannot be reverted.\n";

        return false;
    }
    */
}
