<?php

use yii\db\Schema;
use yii\db\Migration;

class m160130_170236_create_category_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%category}}', [
            'id_category' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'parent' => $this->integer(10)->defaultValue(0),
            'slug' => $this->string(250)->notNull(),
            'slug_compiled' => $this->string(250)->notNull(),
            'top_description' => $this->text(),
            'bottom_description' => $this->text(),
            'h1' => $this->string(250),
            'breadcrumb' => $this->string(250),
            'meta_title' => $this->string(250),
            'meta_description' => $this->string(250),
            'meta_keywords' => $this->string(250),
            'status' => $this->integer(1)->defaultValue(0),

        ], $tableOptions);

        $this->createIndex('idx_page_slug', '{{%category}}', 'slug');
        $this->createIndex('idx_page_slug_compiled', '{{%category}}', 'slug_compiled');
    }

    public function down()
    {
        $this->dropTable('{{%category}}');

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
