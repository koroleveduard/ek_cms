<?php

use yii\db\Schema;
use yii\db\Migration;

class m160130_170329_create_cat_2_product_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%cat_2_product}}', [
            'id_category' => $this->integer(10),
            'id_product' => $this->integer(10),
            'PRIMARY KEY(id_category, id_product)'

        ], $tableOptions);

        $this->createIndex('idx-cat_2_product-cat-id', '{{%cat_2_product}}', 'id_category');
        $this->createIndex('idx-cat_2_product-product_id', '{{%cat_2_product}}', 'id_product');

        $this->addForeignKey('fk-cat_2_product-cat-id', '{{%cat_2_product}}', 'id_category', '{{%category}}', 'id_category', 'CASCADE');
        $this->addForeignKey('fk-cat_2_product-product_id', '{{%cat_2_product}}', 'id_product', '{{%product}}', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%cat_2_product}}');

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
