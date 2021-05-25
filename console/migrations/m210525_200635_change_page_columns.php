<?php

use yii\db\Migration;

/**
 * Class m210525_200635_change_page_columns
 */
class m210525_200635_change_page_columns extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp() {
		$this->alterColumn( 'pages', 'created_at', $this->timestamp()->defaultExpression( 'CURRENT_TIMESTAMP' ) );
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown() {
		$this->alterColumn( 'pages', 'created_at', $this->date() );
	}

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210525_200635_change_page_columns cannot be reverted.\n";

        return false;
    }
    */
}
