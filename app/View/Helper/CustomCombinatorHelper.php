<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 3/9/13
 * Time: 2:42 PM
 * To change this template use File | Settings | File Templates.
 */
App::uses('CombinatorHelper', 'Combinator.View/Helper');

class CustomCombinatorHelper extends CombinatorHelper
{
    /**
     * @param $type
     * @param bool $async
     * @param string $filePrefix
     * @return string
     */
    function scripts($type, $async = false, $filePrefix = 'cache-')
    {
        $this->filePrefix = $filePrefix;
        $script = parent::scripts($type, $async);
        //---logic to find out path of generated compressed file
        switch ($type) {
            case 'js':
                $startFile = strpos($script, 'src="');
                $startFile = $startFile + 6;
                break;
            case 'css':
                $startFile = strpos($script, 'href="');
                $startFile = $startFile + 7;
        }
        $endFile = strpos($script, '"', $startFile);
        $length = $endFile - $startFile;
        $currentFileName = WWW_ROOT .substr($script, $startFile, $length);
        //-----
        $files = scandir($this->cachePath[$type]);
        foreach ($files as $file) {
            $fullFile = $this->cachePath[$type] . '/' . $file;
            if (strpos($file, $filePrefix) === 0 && $fullFile !== $currentFileName) {
                unlink($fullFile);
            }
        }

        return $script;
    }

}
