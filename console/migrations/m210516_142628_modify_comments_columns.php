<?php

use yii\db\Migration;

/**
 * Class m210516_142628_modify_comments_columns
 */
class m210516_142628_modify_comments_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->alterColumn( 'comments', 'comment_text', $this->text() );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->alterColumn( 'comments', 'comment_text', $this->string( 255 ) );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210516_142628_modify_comments_columns cannot be reverted.\n";

        return false;
    }
    */
}
