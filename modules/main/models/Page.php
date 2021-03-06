<?php

namespace app\modules\main\models;

use Yii;
use app\modules\backend\models\Templates;

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
            [['parent_id','status','template_id'], 'integer'],
            [['slug', 'title'], 'required','message' => 'Данное поле обязательно для заполнения'],
            [['content','announce'], 'string'],
            [['slug', 'title','meta_title','meta_description','meta_keywords','slug_compiled','breadcrumb'], 'string', 'max' => 250],
            [['slug'],'unique','message' => 'ЧПУ должно быть уникальным на всю систему'],
            ['created', 'default'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Активен',
            'parent_id' => 'Родительская страница',
            'slug' => 'ЧПУ',
            'title' => 'Заголовок',
            'template_id' => 'Шаблон',
            'meta_title' => 'meta title',
            'meta_description' => 'meta description',
            'meta_keywords' => 'meta keywords',
            'content' => 'Контент',
            'announce' => 'Анонс',
            'created' => 'Дата создания',
            'breadcrumb' => 'Хлебные крошки'
        ];
    }

    public function beforeValidate()
    {
        if ($this->created) {
            $this->created = \DateTime::createFromFormat('d-m-Y', $this->created)->format('U');
        }
        return parent::beforeValidate();
    }

    public function getTemplate()
    {
        return $this->hasOne(Templates::className(), ['id' => 'template_id']);
    }

    public function getParent()
    {
        return $this->hasOne(static::className(), ['id' => 'parent_id']);
    }

    public static function getByUrlPath($slug)
    {
        $page = self::find()->where(['slug_compiled' => $slug,'status'=>1])->one();
        return $page;
    }

    public static function findById($id)
    {
        $id_page = (int)$id;
        $page = self::find()->where(['status'=>1,'id'=>$id_page])->one();
        return $page;
    }
}
