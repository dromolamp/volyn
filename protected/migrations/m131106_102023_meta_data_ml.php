<?php

class m131106_102023_meta_data_ml extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{meta_data_lang}}', array(
            'id'=>'pk',
            'lang_id'=>'VARCHAR(6) NOT NULL',
            'data_id'=>'INT NOT NULL',
            'l_meta_title' => 'varchar(255) NULL',
            'l_meta_keywords' => 'TEXT NULL',
            'l_meta_description' => 'TEXT NULL',
        ));

        $this->addForeignKey('fk_{{meta_data_lang}}_{{meta_data}}', '{{meta_data_lang}}', 'data_id', '{{meta_data}}', 'id', 'cascade', 'cascade');
	}

	public function down()
	{
	}
}