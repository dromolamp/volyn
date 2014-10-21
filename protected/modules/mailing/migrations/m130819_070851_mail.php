<?php

class m130819_070851_mail extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{mail}}', array(
            'id'=>'pk',
            'name'=>'VARCHAR(128) NOT NULL',
            'text'=>'TEXT NOT NULL',
            'pub_date'=>'TIMESTAMP NOT NULL',
            'status'=>'TINYINT(1) NOT NULL DEFAULT 1',
        ), 'ENGINE=InnoDB');
	}

	public function down()
	{
		$this->dropTable("{{mail}}");
	}
}