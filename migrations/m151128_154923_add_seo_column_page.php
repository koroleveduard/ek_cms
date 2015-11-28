<?php

use yii\db\Schema;
use yii\db\Migration;

class m151128_154923_add_seo_column_page extends Migration
{
    public function up()
    {
        $this->addColumn('{{%page}}','breadcrumb','VARCHAR(255)');
    }

    public function down()
    {
        echo "m151128_154923_add_seo_column_page cannot be reverted.\n";

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
