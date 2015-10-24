<?php

namespace app\modules\main\models;

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
class Page extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent'], 'integer'],
            [['slug', 'title'], 'required'],
            [['content'], 'string'],
            [['slug', 'title'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent' => 'Parent',
            'slug' => 'Slug',
            'title' => 'Title',
            'content' => 'Content',
        ];
    }

    public static function getByUrlPath($slug){
        $page = self::find()->where(['slug' => $slug])->one();
        return $page;
    }

    public static function findById($id){
        $id_page = (int)$id;
        return self::findOne($id_page);
    }
}
