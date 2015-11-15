<?php

use yii\db\Schema;
use yii\db\Migration;

class m151115_091508_add_status_page extends Migration
{
    public function up()
    {
         $this->addColumn('{{%page}}','status','INTEGER(1) DEFAULT \'0\'');
    }

    public function down()
    {
        echo "m151115_091508_add_status_page cannot be reverted.\n";

        return false;
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
