<?php

namespace app\modules\backend\models;

use Yii;
use app\modules\backend\models\Product;

/**
 * This is the model class for table "{{%page}}".
 *
 * @property integer $id
 * @property integer $name
 * @property string $path
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required','message' => 'Данное поле обязательно для заполнения'],
            [['name', 'slug','slug_compiled','h1','meta_title','meta_description','meta_keywords'], 'string', 'max' => 250],
            ['status','integer','max'=>1],
            ['parent','integer'],
            [['top_description','bottom_description'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_category' => 'ID',
            'name' => 'Имя',
            'slug' => 'Слаг',
            'slug_compiled' => 'Путь',
            'parent' => 'Родительская категория',
            'top_description' => 'Описание над каталогом',
            'bottom_description' => 'Описание под каталогом',
            'h1' => 'H1',
            'meta_title' => 'meta title',
            'meta_description' => 'meta description',
            'meta_keywords' => 'meta keywords',
            'status' => 'статус',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            $this->slug_compiled = $this->slug;
            $parent = $this->parent;
            while($parent !=0)
            {
                $parent_model = self::findOne($parent);
                $this->slug_compiled = $parent_model->slug.'/'.$this->slug_compiled;
                $parent = $parent_model->parent;
            }
            return true;
        } else {
            return false;
        }
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'id_product'])
             ->viaTable('{{%cat_2_product}}', ['id_category' => 'id_category']);
    }

    public static function findById($id){
        $id_category = (int)$id;
        $category = self::find()->where(['status'=>1,'id_category'=>$id_category])->one();
        return $category;
    }

    public static function getByUrlPath($slug){
        $category = self::find()->where(['slug_compiled' => $slug,'status'=>1])->one();
        return $category;
    }
    
}
