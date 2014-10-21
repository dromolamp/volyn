<?php

class m130419_072033_menu extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{menu}}', array(
            'id' => 'pk',
            'title' => 'varchar(128) NOT NULL',
            'image' => 'varchar(128) NULL',
            'route_id' => 'INT NULL',
            'root' => 'int(11) unsigned DEFAULT NULL',
            'lft' => 'int(11) unsigned NOT NULL',
            'rgt' => 'int(11) unsigned NOT NULL',
            'level' => 'smallint(5) unsigned NOT NULL',
            'status' => 'TINYINT(1) NOT NULL DEFAULT 1',
            'parent_id' => 'INT NULL',
        ), 'ENGINE=InnoDB');
	}

	public function down()
	{
        $this->dropTable('{{menu}}');
	}
}