<?php

namespace app\modules\backend\models;

use Yii;

/**
 * This is the model class for table "{{%page}}".
 *
 * @property integer $id
 * @property integer $parent
 * @property string $slug
 * @property string $title
 * @property string $content
 */
class Page extends \app\modules\main\models\Page
{

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->slug_compiled = $this->slug;
            $parent = $this->parent;
            while ($parent !=0) {
                $parent_model = self::findOne($parent);
                $this->slug_compiled = $parent_model->slug.'/'.$this->slug_compiled;
                $parent = $parent_model->parent;
            }
            return true;
        } else {
            return false;
        }
    }
}
