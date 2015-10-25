<?php

namespace app\components;

use app\modules\main\models\Page;
use Yii;
use yii\web\UrlRuleInterface;

class PageRule implements UrlRuleInterface
{
    /**
     * @inheritdoc
     */
    public function createUrl($manager, $route, $params)
    {

     if($route == 'main/page/show') {
         if (isset($params['id'])) {
             $model = Page::findById($params['id']);
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
        if (null !== $model = Page::getByUrlPath($slug)) {
            return [
                '/main/page/show/',
                ['id' => $model['id']]
            ];
        }
        return false;
    }
}
