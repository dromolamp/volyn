<?php

class m131106_094933_meta_data extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{meta_data}}', array(
            'id' => 'pk',
            'model' => 'varchar(128) NOT NULL',
            'model_id' => 'INT NOT NULL',
            'meta_title' => 'varchar(255) NULL',
            'meta_keywords' => 'TEXT NULL',
            'meta_description' => 'TEXT NULL',
        ), 'ENGINE=InnoDB');
	}

	public function down()
	{
	}

}