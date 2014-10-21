<?php

class m140611_070239_services extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{services}}', array(
            'id'=>'pk',
            'title'=>'TEXT NOT NULL',
            'header'=>'TEXT NULL',
            'content'=>'TEXT NULL',
            'footer'=>'TEXT NULL',
            'file'=>'VARCHAR(255) NULL',
            'manager_id'=> 'INT NOT NULL',
            'seo_link'=>'TEXT NOT NULL',
            'date_create'=>'DATETIME NOT NULL',
            'date_update'=>'DATETIME NOT NULL',
            'status'=>'TINYINT(1) NOT NULL DEFAULT 0', // public, draft, deleted
        ),'ENGINE=InnoDB');

        $this->addForeignKey('fk_{{services}}_1', '{{services}}', 'manager_id', '{{manager}}', 'id', 'cascade', 'cascade');

        $this->createTable('{{services_lang}}', array(
            'id'=>'pk',
            'lang_id'=>'VARCHAR(6) NOT NULL',
            'services_id'=>'INT NOT NULL',
            'l_title' => 'TEXT NOT NULL',
            'l_header' => 'TEXT NULL',
            'l_content' => 'TEXT NULL',
            'l_footer' => 'TEXT NULL',
        ));

        $this->addForeignKey('fk_{{services_lang}}_1', '{{services_lang}}', 'services_id', '{{services}}', 'id', 'cascade', 'cascade');
	}

	public function down()
	{
		echo "m140611_070239_services does not support migration down.\n";
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