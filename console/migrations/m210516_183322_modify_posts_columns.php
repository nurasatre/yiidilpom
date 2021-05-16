<?php

use yii\db\Migration;

/**
 * Class m210516_183322_modify_posts_columns
 */
class m210516_183322_modify_posts_columns extends Migration {
	/**
	 * {@inheritdoc}
	 */
	public function safeUp() {
		$this->alterColumn( 'posts', 'created_at', $this->timestamp()->defaultExpression( 'CURRENT_TIMESTAMP' ) );
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown() {
		$this->alterColumn( 'posts', 'created_at', $this->timestamp() );
	}

	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m210516_183322_modify_posts_columns cannot be reverted.\n";

		return false;
	}
	*/
}
