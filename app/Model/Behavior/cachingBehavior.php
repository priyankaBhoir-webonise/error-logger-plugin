<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 30/8/13
 * Time: 2:59 PM
 * To change this template use File | Settings | File Templates.
 */
App::uses('ModelBehavior', 'Model');

class cachingBehavior extends ModelBehavior{
    private $key;

//    public function setup(Model $model,$settings=array()){
//        $this->prefix=$model->name;
//    }
//    function beforeFind(Model $model,array $query){
//        $this->key=$model->name.''.print_r($query,true);
//        $result=Cache::read($this->key);
//        echo 'before find :';
//       //print_r($result);
//        if(!empty($result)){
//           $model->data=$result;
//            //return false;
//        }
//        return true;
//    }
//
//    function afterFind(Model $model,array $result){
//        $result=Cache::write($this->key,$result);
//    }

    function customFind($model,$type,$params,$isUpdating=false)
    {
        if ($model->cache) {
            $tag = isset($model->name) ? '_' . $model->name : 'appmodel';
            $paramsHash = md5(serialize($params));
            $version = (int)Cache::read($tag);
            $fullTag = $tag . '_' . $type . '_' . $paramsHash;
            if ($result = Cache::read($fullTag)) {
                if ($result['version'] == $version)
                    if($isUpdating){
                        cache::delete($tag);
                        cache::delete($fullTag);
                    }
                    return $result['data'];
            }
            $result = array('version' => $version, 'data' => $model->find($type, $params), );
            if(!$isUpdating){
                Cache::write($fullTag, $result);
                Cache::write($tag, $version);
            }
            return $result['data'];
        } else{
            return $model->find($type,$params);
        }
    }
    function customDelete(Model $model,$id){
        $post=$model->customFind('first',array('conditions'=>array($model->name.'.id'=>$id)),true);
        return $model->delete($id);
    }
}