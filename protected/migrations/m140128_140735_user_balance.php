<?php

class m140128_140735_user_balance extends CDbMigration
{
	public function up()
	{
        $this->addColumn('{{user}}', 'balance', 'DECIMAL(10,2) NOT NULL DEFAULT 0');
        $this->addColumn('{{user}}', 'bonuses', 'DECIMAL(10,2) NOT NULL DEFAULT 0');
	}

	public function down()
	{
	}
}