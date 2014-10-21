<?php

class m140611_064010_manager extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{manager_category}}', array(
            'id'=>'pk',
            'name' => 'TEXT NOT NULL',
        ),'ENGINE=InnoDB');

        $this->createTable('{{manager}}', array(
            'id'=>'pk',
            'category_id'=>'INT NOT NULL',
            'name' => 'TEXT NOT NULL',
            'position'=>'TEXT NOT NULL',
            'image'=>'VARCHAR(255) NULL',
            'address'=>'TEXT NULL',
            'phone'=>'TEXT NULL',
            'fax'=>'TEXT NULL',
            'email'=>'TEXT NULL',
            'skype' => 'TEXT NULL',
            'status'=>'TINYINT(1) NOT NULL DEFAULT 1', // public, draft, deleted
        ),'ENGINE=InnoDB');

        $this->addForeignKey('fk_{{manager}}_1', '{{manager}}', 'category_id', '{{manager_category}}', 'id', 'cascade', 'cascade');


        $this->createTable('{{manager_lang}}', array(
            'id'=>'pk',
            'lang_id'=>'VARCHAR(6) NOT NULL',
            'manager_id'=>'INT NOT NULL',
            'l_position' => 'TEXT NULL',
            'l_name' => 'TEXT NULL',
            'l_address' => 'TEXT NULL',
        ));

        $this->addForeignKey('fk_{{manager_lang}}_1', '{{manager_lang}}', 'manager_id', '{{manager}}', 'id', 'cascade', 'cascade');

        $this->createTable('{{manager_phone}}', array(
            'id'=>'pk',
            'manager_id'=>'INT NOT NULL',
            'phone'=>'TEXT NULL',
            'status'=>'TINYINT(1) NOT NULL DEFAULT 1', // public, draft, deleted
        ),'ENGINE=InnoDB');

        $this->addForeignKey('fk_{{manager_phone}}_1', '{{manager_phone}}', 'manager_id', '{{manager}}', 'id', 'cascade', 'cascade');
	}

	public function down()
	{
		echo "m140611_064010_manager does not support migration down.\n";
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