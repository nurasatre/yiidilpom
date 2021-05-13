<?php

use yii\db\Migration;

/**
 * Class m210512_220448_add_pages_column
 */
class m210512_220448_add_pages_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->addColumn( 'pages', 'attachment_id', $this->integer() );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->dropColumn( 'pages', 'attachment_id' );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210512_220448_add_pages_column cannot be reverted.\n";

        return false;
    }
    */
}
