<?php

use yii\db\Schema;
use yii\db\Migration;

class m160130_170255_create_product_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%product}}', [
            'id_product' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'slug' => $this->string(250)->notNull(),
            'main_category' => $this->integer(10)->notNull(),
            'anounce' => $this->text(),
            'description' => $this->text(),
            'h1' => $this->string(250),
            'breadcrumb' => $this->string(250),
            'meta_title' => $this->string(250),
            'meta_description' => $this->string(250),
            'meta_keywords' => $this->string(250),
            'status' => $this->integer(1)->defaultValue(0),

        ], $tableOptions);

        $this->createIndex('idx_product_slug', '{{%product}}', 'slug');
    }

    public function down()
    {
        $this->dropTable('{{%product}}');

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
