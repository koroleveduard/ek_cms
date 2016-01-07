<?php

use yii\db\Schema;
use yii\db\Migration;

class m160107_145437_Settings extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%settings}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(250)->notNull(),
            'value' => $this->text(),

        ], $tableOptions);

        $this->createIndex('idx_settings_name', '{{%settings}}', 'name');
    }

    public function down()
    {
        echo "m160107_145437_Settings cannot be reverted.\n";

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
