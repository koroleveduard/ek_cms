<?php

namespace app\modules\backend\models;

use Yii;
use app\modules\backend\models\Category;
use app\modules\backend\models\Settings;

/**
 * This is the model class for table "{{%page}}".
 *
 * @property integer $id
 * @property integer $name
 * @property string $path
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required','message' => 'Данное поле обязательно для заполнения'],
            [['name', 'slug','h1','meta_title','meta_description','meta_keywords','breadcrumb'], 'string', 'max' => 250],
            [['status'],'integer','max'=>1],
            [['main_category','template_id'],'integer'],
            [['description','anounce'], 'string'],
            [['category_ids'], 'each', 'rule' => ['integer']],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => \voskobovich\behaviors\ManyToManyBehavior::className(),
                'relations' => [
                    'category_ids' => 'categories',
                ],
            ],
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    public static function listAll($keyField = 'id_category', $valueField = 'name', $asArray = true)
    {
        $query = static::find();
        if ($asArray) {
                $query->select([$keyField, $valueField])->asArray();
        }

        return ArrayHelper::map($query->all(), $keyField, $valueField);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'    =>  'ID',
            'name'  =>  'Имя',
            'slug'  =>  'Слаг',
            'anounce'   =>  'Анонс',
            'description'   =>  'Описание',
            'h1'    =>  'H1',
            'meta_title'    =>  'meta title',
            'meta_description'  =>  'meta description',
            'meta_keywords' =>  'meta keywords',
            'status'    =>  'статус',
            'category_ids' => 'Категория',
            'main_category' => 'Главная категория',
            'image' => 'Изображение',
            'breadcrumb' => 'Хлебные крошки',
            'template_id' => 'Шаблон'
        ];
    }

    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id_category' => 'id_category'])
             ->viaTable('{{%cat_2_product}}', ['id_product' => 'id']);
    }

    public function getMain()
    {
        return $this->hasOne(Category::className(), ['id_category' => 'main_category']);
    }

    public function getTemplate()
    {
        return $this->hasOne(Templates::className(), ['id' => 'template_id']);
    }

    public static function getByUrlPath($slug)
    {
        $include_cat_slug = Settings::find()->where(['name' => 'category_in_product_slug'])->one()->value;
        //если в роутинг включены категории
        if ($include_cat_slug) {
            $slug_part = explode('/', $slug);
            $product_slug = $slug_part[count($slug_part)-1];
            unset($slug_part[count($slug_part)-1]);
            $category_slug = implode('/', $slug_part);
            $product = self::find()->where(['slug' => $product_slug,'status'=>1])->one();
            if ($product != null && $product->main->slug_compiled == $category_slug) {
                return $product;
            } else {
                return null;
            }
        }
        $product = self::find()->where(['slug' => $slug,'status'=>1])->one();
        return $product;
    }

    public static function findById($id)
    {
        $id_product = (int)$id;
        $product = self::find()->where(['status'=>1,'id'=>$id_product])->one();
        return $product;
    }
}
