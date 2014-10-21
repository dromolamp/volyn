<?php

class m141013_114113_production extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{production}}', array(
            'id'=>'pk',
            'date_create'=>'DATETIME NOT NULL',
            'date_update'=>'DATETIME NOT NULL',
            'seo_link'=>'TEXT NOT NULL',
            'title'=>'TEXT NOT NULL',
            'text'=>'TEXT NOT NULL',
            'image'=>'VARCHAR(255) NOT NULL',
            'date_public'=>'DATETIME NOT NULL',
            'status'=>'TINYINT(1) NOT NULL DEFAULT 0', // public, draft, deleted
        ),'ENGINE=InnoDB');

        $this->createTable('{{production_lang}}', array(
            'id'=>'pk',
            'lang_id'=>'VARCHAR(6) NOT NULL',
            'production_id'=>'INT NOT NULL',
            'l_title' => 'TEXT NOT NULL',
            'l_text' => 'TEXT NULL',
        ));
        $this->addForeignKey('fk_{{production_lang}}_1', '{{production_lang}}', 'production_id', '{{production}}', 'id', 'cascade', 'cascade');
    }

	public function down()
	{
		echo "m141013_114113_production does not support migration down.\n";
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