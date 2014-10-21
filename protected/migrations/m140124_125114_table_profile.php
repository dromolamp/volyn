<?php

class m140124_125114_table_profile extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{profile}}', array(
            'id'=>'pk',
            'city'=>'VARCHAR(255) NULL',
            'birthday'=>'DATE NULL',
            'sex'=>'TINYINT(1) NULL',
            'photo'=>'VARCHAR(100) NULL',
            'is_get_news' => 'TINYINT(1) NULL',
            'user_id'=> 'INT NOT NULL',
        ),'ENGINE=InnoDB');

	}

	public function down()
	{
		echo "m140124_125114_table_profile does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}