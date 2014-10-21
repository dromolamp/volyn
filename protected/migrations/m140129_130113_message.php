<?php

class m140129_130113_message extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{message}}', array(
            'id'=>'pk',
            'from_user_id'=>'INT NOT NULL',
            'to_user_id'=>'INT NOT NULL',
            'message'=>'TEXT NULL',
            'date_create'=>'TIMESTAMP NOT NULL',
            'status_from'=>'INT NOT NULL DEFAULT 1',
            'status_to'=>'INT NOT NULL DEFAULT 0',
        ));
	}

	public function down()
	{
		echo "m140129_130113_message does not support migration down.\n";
		return false;
	}
}