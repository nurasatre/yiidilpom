<?php

use yii\db\Migration;

/**
 * Class m210513_231105_add_posts_column
 */
class m210513_231105_add_posts_column extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->addColumn( 'posts', 'attachment_id', $this->integer() );
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropColumn( 'posts', 'attachment_id' );
	}

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210513_231105_add_posts_column cannot be reverted.\n";

        return false;
    }
    */
}
