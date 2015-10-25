<?php

use yii\db\Schema;
use yii\db\Migration;

class m151022_125542_create_page_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%page}}', [
            'id' => $this->primaryKey(),
            'parent' => $this->integer(5)->defaultValue(0),
            'slug' => $this->string(250)->notNull(),
            'title' => $this->string(250)->notNull(),
            'content' => $this->text(),

        ], $tableOptions);

        $this->createIndex('idx_page_slug', '{{%page}}', 'slug');
    }

    public function down()
    {
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
