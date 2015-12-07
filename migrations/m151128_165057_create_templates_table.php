<?php

use yii\db\Schema;
use yii\db\Migration;

class m151128_165057_create_templates_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%templates}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(250)->notNull(),
            'path' => $this->string(250)->notNull(),

        ], $tableOptions);
    }

    public function down()
    {
        echo "m151128_165057_create_templates_table cannot be reverted.\n";

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
