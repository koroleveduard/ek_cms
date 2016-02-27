<?php

namespace app\components;

use app\modules\backend\models\Category;
use app\modules\backend\models\Product;
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
