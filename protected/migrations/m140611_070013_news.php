<?php

class m140611_070013_news extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{news}}', array(
            'id'=>'pk',
            'name'=>'TEXT NOT NULL',
            'text'=>'TEXT NULL',
            'image'=>'VARCHAR(255) NULL',
            'seo_link'=>'TEXT NOT NULL',
            'date_public'=>'DATETIME NOT NULL',
            'date_create'=>'DATETIME NOT NULL',
            'date_update'=>'DATETIME NOT NULL',
            'type' => 'TINYINT(1) NOT NULL DEFAULT 0', // news, expert advice
            'status'=>'TINYINT(1) NOT NULL DEFAULT 0', // public, draft, deleted
        ),'ENGINE=InnoDB');

        $this->createTable('{{news_lang}}', array(
            'id'=>'pk',
            'lang_id'=>'VARCHAR(6) NOT NULL',
            'news_id'=>'INT NOT NULL',
            'l_name' => 'TEXT NOT NULL',
            'l_text' => 'TEXT NULL',
        ));

        $this->addForeignKey('fk_{{news_lang}}_1', '{{news_lang}}', 'news_id', '{{news}}', 'id', 'cascade', 'cascade');
	}

	public function down()
	{
		echo "m140611_070013_news does not support migration down.\n";
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