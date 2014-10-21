<?php

class m140611_075752_contact extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{contact}}', array(
            'id'=>'pk',
            'name'=>'TEXT NOT NULL',
            'manager_id'=> 'INT NOT NULL',
            'status'=>'TINYINT(1) NOT NULL DEFAULT 1', // public, draft, deleted
        ),'ENGINE=InnoDB');

        $this->addForeignKey('fk_{{contact}}_{{manager}}_1', '{{contact}}', 'manager_id', '{{manager}}', 'id', 'cascade', 'cascade');

        $this->createTable('{{contact_lang}}', array(
            'id'=>'pk',
            'lang_id'=>'VARCHAR(6) NOT NULL',
            'contact_id'=>'INT NOT NULL',
            'l_name' => 'TEXT NULL',
        ));

        $this->addForeignKey('fk_{{contact_lang}}_1', '{{contact_lang}}', 'contact_id', '{{contact}}', 'id', 'cascade', 'cascade');
	}

	public function down()
	{
		echo "m140611_075752_contact does not support migration down.\n";
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