<?php

class m140129_080132_user_last_activity extends CDbMigration
{
	public function up()
	{
        $this->addColumn('{{user}}', 'last_activity', 'TIMESTAMP NULL DEFAULT NULL');
	}

	public function down()
	{
	}
}