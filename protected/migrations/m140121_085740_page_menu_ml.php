<?php

class m140121_085740_page_menu_ml extends CDbMigration
{
	public function up()
	{
        $this->dropColumn('{{page}}', 'lang_id');
        $this->dropColumn('{{page}}', 'parent_id');

        $this->createTable('{{page_lang}}', array(
            'id'=>'pk',
            'lang_id'=>'VARCHAR(6) NOT NULL',
            'page_id'=>'INT NOT NULL',
            'l_title' => 'varchar(255) NOT NULL',
            'l_content' => 'TEXT NULL',
        ));

        $this->addForeignKey('fk_{{page_lang}}_{{page}}', '{{page_lang}}', 'page_id', '{{page}}', 'id', 'cascade', 'cascade');

        $this->createTable('{{menu_lang}}', array(
            'id'=>'pk',
            'l_title'=>'VARCHAR(128) NOT NULL',
            'menu_id'=>'INT NOT NULL',
            'lang_id'=>'VARCHAR(6) NOT NULL',
        ));
        $this->addForeignKey('fk_{{menu_lang}}_{{menu}}', '{{menu_lang}}', 'menu_id', '{{menu}}', 'id', 'cascade', 'cascade');
	}

	public function down()
	{
	}
}