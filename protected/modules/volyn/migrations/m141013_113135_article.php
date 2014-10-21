<?php

class m141013_113135_article extends CDbMigration
{
    public function up()
    {
        $this->createTable('{{article}}', array(
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

        $this->createTable('{{article_lang}}', array(
            'id'=>'pk',
            'lang_id'=>'VARCHAR(6) NOT NULL',
            'article_id'=>'INT NOT NULL',
            'l_title' => 'TEXT NOT NULL',
            'l_text' => 'TEXT NULL',
        ));
        $this->addForeignKey('fk_{{article_lang}}_1', '{{article_lang}}', 'article_id', '{{article}}', 'id', 'cascade', 'cascade');
    }

	public function down()
	{
		echo "m141013_113135_article does not support migration down.\n";
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