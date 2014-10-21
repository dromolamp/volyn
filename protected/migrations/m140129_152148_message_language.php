<?php

class m140129_152148_message_language extends CDbMigration
{
	public function up()
	{
        $this->addColumn('{{message}}', 'lesson_language_id', 'INT NOT NULL');
	}

	public function down()
	{
		echo "m140129_152148_message_language does not support migration down.\n";
		return false;
	}
}