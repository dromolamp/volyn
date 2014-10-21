<?php

class m130716_111556_page extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{page}}', array(
            'id' => 'pk',
            'title' => 'varchar(255) NOT NULL',
            'content' => 'TEXT NULL',
            'pub_date' => 'TIMESTAMP NOT NULL',
            'author_id' => 'INT NOT NULL',
            'lang_id'=>'TINYINT(2) NOT NULL',
            'parent_id'=>'INT NULL',
        ), 'ENGINE=InnoDB');
        $this->addForeignKey('fk_{{page}}_{{user}}', '{{page}}', 'author_id', '{{user}}', 'id');
	}

	public function down()
	{
        $this->dropForeignKey('fk_{{page}}_{{user}}', '{{page}}');
        $this->dropTable('{{page}}');
	}
}