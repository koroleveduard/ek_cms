<?php

namespace app\modules\backend\models;

use Yii;
use app\modules\main\models\Page;

/**
 * This is the model class for table "{{%page}}".
 *
 * @property integer $id
 * @property integer $name
 * @property string $path
 */
class Templates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%templates}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'path'], 'required',],
            [['name', 'path',], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'path' => 'Путь до шаблона',
        ];
    }

    public function getPages()
    {
        return $this->hasMany(Page::className(), ['template' => 'id']);
    }
}
