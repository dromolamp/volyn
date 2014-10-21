<?php

class m140131_124539_social_links extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{social_network_link}}', array(
            'id'=>'pk',
            'name'=>'VARCHAR(128) NOT NULL',
            'link'=>'VARCHAR(255) NOT NULL',
            'css_class'=>'VARCHAR(100) NOT NULL',
            'status'=>'TINYINT(1) NOT NULL DEFAULT 1'
        ));
	}

	public function down()
	{
	}
}