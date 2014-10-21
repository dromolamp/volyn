<?php

class m140124_152118_table_social_network extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{social_network_user}}', array(
            'id'=>'pk',
            'network_id'=>'VARCHAR(45) NOT NULL',
            'social_network_user_id'=>'VARCHAR(100) NOT NULL',
            'username'=>'VARCHAR(255) NULL',
            'user_id'=>'INT NOT NULL',
        ), 'ENGINE=InnoDB');

        $this->addForeignKey('fk_{{social_network_user}}_{{user}}', '{{social_network_user}}', 'user_id', '{{user}}', 'id');
	}

	public function down()
	{
		echo "m140124_152118_table_social_network does not support migration down.\n";
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