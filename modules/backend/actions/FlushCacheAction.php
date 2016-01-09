<?php
namespace app\modules\backend\actions;

use yii\base\Action;
use Symfony\Component\Finder\Iterator\RecursiveDirectoryIterator;

class FlushCacheAction extends Action{
	public $view = 'message';

	protected function flushCache()
	{
		 $dir = \Yii::getAlias('@runtime/cache');
		 $it = new \RecursiveDirectoryIterator($dir, \RecursiveDirectoryIterator::SKIP_DOTS);
		 $files = new \RecursiveIteratorIterator($it, \RecursiveIteratorIterator::CHILD_FIRST);
		 foreach($files as $file)
		 {
		 	if ($file->isDir() && $file->isLink() === false) {
                $result = @rmdir($file->getRealPath());
            } elseif ($file->isLink() === true) {
                $result = @unlink($file->getPath() . DIRECTORY_SEPARATOR . $file->getFilename());
            } else {
                $result = @unlink($file->getRealPath());
            }
		 }
	} 

	public function run()
    {
    	$this->flushCache();
        return $this->controller->renderPartial($this->view);
    }
}