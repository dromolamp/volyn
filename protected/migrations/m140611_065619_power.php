<?php

class m140611_065619_power extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{power}}', array(
            'id'=>'pk',
            'title'=>'TEXT NOT NULL',
            'text'=>'TEXT NOT NULL',
            'image'=>'TEXT NULL',
            'status'=>'TINYINT(1) NOT NULL DEFAULT 1', // public, draft, deleted
        ),'ENGINE=InnoDB');

        $this->createTable('{{power_lang}}', array(
            'id'=>'pk',
            'lang_id'=>'VARCHAR(6) NOT NULL',
            'power_id'=>'INT NOT NULL',
            'l_title' => 'TEXT NULL',
            'l_text' => 'TEXT NULL',
        ));

        $this->addForeignKey('fk_{{power_lang}}_1', '{{power_lang}}', 'power_id', '{{power}}', 'id', 'cascade', 'cascade');
	}

	public function down()
	{
		echo "m140611_065619_power does not support migration down.\n";
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