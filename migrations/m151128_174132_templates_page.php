<?php

use yii\db\Schema;
use yii\db\Migration;

class m151128_174132_templates_page extends Migration
{
    public function up()
    {
        $this->addColumn('{{%page}}','template_id','INTEGER(10) DEFAULT \'0\'');
    }

    public function down()
    {
        echo "m151128_174132_templates_page cannot be reverted.\n";

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
