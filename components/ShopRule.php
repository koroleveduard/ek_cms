<?php

namespace app\components;

use app\modules\backend\models\Category;
use app\modules\backend\models\Product;
use app\modules\backend\models\Settings;
use Yii;
use yii\web\UrlRuleInterface;

class ShopRule implements UrlRuleInterface
{
    /**
     * @inheritdoc
     */
    public function createUrl($manager, $route, $params)
    {

     if($route == 'main/category/show') {
         if (isset($params['id'])) {
             $model = Category::findById($params['id']);
             unset($params['id']);
         }
         if (null !== $model) {
             $url = $model->slug_compiled;
             $_query = http_build_query($params);
             $url = (!empty($_query)) ? $url . '?' . $_query : $url;
             return $url;
         }
     }

     if($route == 'main/product/show') {
         if (isset($params['id'])) {
             $model = Product::findById($params['id']);
             unset($params['id']);
         }
        $include_cat_slug = Settings::find()->where(['name' => 'category_in_product_slug'])->one()->value;
         if (null !== $model) {
             $url = ($include_cat_slug) ? $model->main->slug_compiled.'/'.$model->slug  : $model->slug;
             $_query = http_build_query($params);
             $url = (!empty($_query)) ? $url . '?' . $_query : $url;
             return $url;
         }
     }

     return false;
    }

    /**
     * @inheritdoc
     */
    public function parseRequest($manager, $request)
    {
        $slug = $request->getPathInfo();
        if (null !== $model = Category::getByUrlPath($slug)) {
            return [
                '/main/category/show/',
                ['id' => $model['id_category']]
            ];
        }

        if (null !== $model = Product::getByUrlPath($slug)) {
            return [
                '/main/product/show/',
                ['id' => $model['id_product']]
            ];
        }
        return false;
    }
}
