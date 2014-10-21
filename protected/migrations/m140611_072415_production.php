<?php

class m140611_072415_production extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{production}}', array(
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
            'type'=>'TINYINT(1) NOT NULL DEFAULT 0', // Export, Import, Feed, Oil,
        ),'ENGINE=InnoDB');

        $this->addForeignKey('fk_{{production}}_1', '{{production}}', 'manager_id', '{{manager}}', 'id', 'cascade', 'cascade');

        $this->createTable('{{production_lang}}', array(
            'id'=>'pk',
            'lang_id'=>'VARCHAR(6) NOT NULL',
            'production_id'=>'INT NOT NULL',
            'l_title' => 'TEXT NOT NULL',
            'l_header' => 'TEXT NULL',
            'l_content' => 'TEXT NULL',
            'l_footer' => 'TEXT NULL',
        ));

        $this->addForeignKey('fk_{{production_lang}}_1', '{{production_lang}}', 'production_id', '{{production}}', 'id', 'cascade', 'cascade');


        $this->createTable('{{production_product}}', array(
            'id'=>'pk',
            'production_id'=>'INT NOT NULL',
            'image'=>'VARCHAR(255) NULL',
            'title'=>'TEXT NOT NULL',
            'header'=>'TEXT NULL',
            'content'=>'TEXT NULL',
            'footer'=>'TEXT NULL',
            'file'=>'VARCHAR(255) NULL',
            'seo_link'=>'TEXT NOT NULL',
            'date_create'=>'DATETIME NOT NULL',
            'date_update'=>'DATETIME NOT NULL',
            'status'=>'TINYINT(1) NOT NULL DEFAULT 0', // public, draft, deleted
        ),'ENGINE=InnoDB');

        $this->addForeignKey('fk_{{production_product}}_1', '{{production_product}}', 'production_id', '{{production}}', 'id', 'cascade', 'cascade');


        $this->createTable('{{production_product_lang}}', array(
            'id'=>'pk',
            'lang_id'=>'VARCHAR(6) NOT NULL',
            'production_product_id'=>'INT NOT NULL',
            'l_title' => 'TEXT NOT NULL',
            'l_header' => 'TEXT NULL',
            'l_content' => 'TEXT NULL',
            'l_footer' => 'TEXT NULL',
        ));

        $this->addForeignKey('fk_{{production_product_lang}}_1', '{{production_product_lang}}', 'production_product_id', '{{production_product}}', 'id', 'cascade', 'cascade');
	}

	public function down()
	{
		echo "m140611_072415_production does not support migration down.\n";
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