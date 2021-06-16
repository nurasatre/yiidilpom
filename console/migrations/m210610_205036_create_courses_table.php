<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%courses}}`.
 */
class m210610_205036_create_courses_table extends Migration {
	/**
	 * {@inheritdoc}
	 */
	public function safeUp() {
		$this->createTable( '{{%courses}}', [
			'id'         => $this->primaryKey(),
			'title'      => $this->string(),
			'desc'       => $this->string(),
			'file_id'    => $this->integer(),
			'created_at' => $this->timestamp()->defaultExpression( 'CURRENT_TIMESTAMP' ),
			'updated_at' => $this->timestamp(),
		] );
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown() {
		$this->dropTable( '{{%courses}}' );
	}
}
