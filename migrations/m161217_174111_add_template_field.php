<?php

use yii\db\Migration;

class m161217_174111_add_template_field extends Migration
{
    public function up()
	{
		$this->addColumn('{{%product}}','template_id','INTEGER(10) DEFAULT 0');
		$this->addColumn('{{%category}}','template_id','INTEGER(10) DEFAULT 0');
    }

    public function down()
    {
		$this->dropColumn('{{%product}}','template_id');
		$this->dropColumn('{{%category}}','template_id');
        return true;
    }

}
