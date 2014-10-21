<?php

class m140128_150423_menu_css_class extends CDbMigration
{
	public function up()
	{
        $this->addColumn('{{menu}}', 'css_class', 'VARCHAR(255) NULL DEFAULT NULL');
	}

	public function down()
	{
	}
}