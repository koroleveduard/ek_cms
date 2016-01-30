<?php

use yii\db\Schema;
use yii\db\Migration;

class m160129_190114_add_some_fields_to_page extends Migration
{
    public function up()
    {
    	 $this->addColumn('{{%page}}','announce','TEXT');
    	 $this->addColumn('{{%page}}','created','integer(12) DEFAULT \'0\'');
    }

    public function down()
    {
        $this->dropColumn('{{%page}}', 'announce');
        $this->dropColumn('{{%page}}', 'created');

        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
