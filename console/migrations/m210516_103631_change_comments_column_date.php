<?php

use yii\db\Migration;

/**
 * Class m210516_103631_change_comments_column_date
 */
class m210516_103631_change_comments_column_date extends Migration {
	/**
	 * {@inheritdoc}
	 */
	public function safeUp() {
		$this->dropColumn( 'comments', 'data' );
		$this->addColumn( 'comments', 'created_at', $this->timestamp()->defaultExpression( 'CURRENT_TIMESTAMP' ) );
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown() {
		$this->addColumn( 'comments', 'data', $this->date() );
		$this->dropColumn( 'comments', 'created_at' );
	}

	/*
	// Use up()/down() to run migration code without a transaction.
	public function up()
	{

	}

	public function down()
	{
		echo "m210516_103631_change_comments_column_date cannot be reverted.\n";

		return false;
	}
	*/
}
