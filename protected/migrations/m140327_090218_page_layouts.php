<?php

class m140327_090218_page_layouts extends CDbMigration
{
	public function safeUp()
	{
        //m140327_090218_page_layouts.php
        $this->addColumn('{{page}}', 'layouts', 'VARCHAR(128) NULL');
	}

	public function safeDown()
	{
		echo "m140327_090218_page_layouts does not support migration down.\n";
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