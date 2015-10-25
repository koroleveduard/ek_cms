<?php

use yii\db\Schema;
use yii\db\Migration;

class m151024_132755_add_column_page extends Migration
{
    public function up()
    {
        $this->addColumn('{{%page}}','slug_compiled','VARCHAR(255) NOT NULL');
        $this->addColumn('{{%page}}','meta_title','VARCHAR(255)');
        $this->addColumn('{{%page}}','meta_description','VARCHAR(255)');
        $this->addColumn('{{%page}}','meta_keywords','VARCHAR(255)');
    }

    public function down()
    {
        echo "m151024_132755_add_column_page cannot be reverted.\n";

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
