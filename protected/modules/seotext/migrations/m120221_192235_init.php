<?php

class m120221_192235_init extends CDbMigration
{
	public function safeUp()
	{
        $this->createTable('{{seotext}}', array(
            'id' => 'pk',
            'page_title' => 'VARCHAR(255) NOT NULL',
            'meta_desc' => 'VARCHAR(255) NOT NULL',
            'meta_keys' => 'VARCHAR(255) NOT NULL',
            'link' => 'VARCHAR(255) NOT NULL',
            'status' => 'TINYINT(1) NOT NULL DEFAULT 1',
        ), 'ENGINE=InnoDB');


	}

	public function safeDown()
	{
        $this->dropTable('{{seotext}}');
	}
}
