<?php

use yii\db\Migration;

class m160318_095557_demo_settings extends Migration
{
    public function up()
    {
    	$this->insert('{{%settings}}',[
    		'name' => 'hostName',
    		'value' => NULL
    	]);

    	$this->insert('{{%settings}}',[
    		'name' => 'enable_cache',
    		'value' => '0'
    	]);

    	$this->insert('{{%settings}}',[
    		'name' => 'category_in_product_slug',
    		'value' => '1'
    	]);
    }

    public function down()
    {
        $this->delete('{{%settings}}',"name IN ('hostName','enable_cache','category_in_product_slug')");

        return true;
    }
}
