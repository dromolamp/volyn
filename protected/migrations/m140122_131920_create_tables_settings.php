<?php

class m140122_131920_create_tables_settings extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{setting}}', array(
            'id'=>'pk',
            'key'=>'VARCHAR(100) NOT NULL',
            'title'=>'VARCHAR(255) NULL',
            'value'=>'TEXT NOT NULL'
        ),'ENGINE=InnoDB');

        $this->createTable('{{setting_lang}}', array(
            'id'=>'pk',
            'setting_id'=>'INT NOT NULL',
            'lang_id'=>'VARCHAR(6) NOT NULL',
            'l_title'=>'VARCHAR(255) NOT NULL',
            'l_value'=>'TEXT NOT NULL'
        ),'ENGINE=InnoDB');
	}

	public function down()
	{
		echo "m140122_131920_create_tables_settings does not support migration down.\n";
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