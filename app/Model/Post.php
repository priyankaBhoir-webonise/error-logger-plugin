<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 6/8/13
 * Time: 1:57 PM
 * To change this template use File | Settings | File Templates.
 */
class Post extends AppModel{
    public $validate = array('title' => array('rule' => 'notEmpty'),
                             'body' => array('rule' => 'notEmpty'));
    public $actsAs = array('Search.Searchable','caching');
    public $filterArgs = array(
        'title' => array('type' => 'like')
        );
    public $belongsTo='User';
    var $cache = true;
    public function isOwnedBy($post, $user) {
        return $this->field('id', array('id' => $post, 'user_id' => $user)) === $post;
    }

//    public function beforeFind(Array $query){
//       // echo 'got before find : ';
//       //print_r($query);
//        $key=$this->name.print_r($query,true);
//        $result=Cache::read($key);
//        print_r($result);
//        if(empty($result)){
//            return true;
//        }
//        else{
//           $this->data=$result;
//            //return false;
//        }
//    }
//    public function afterFind($result){
//        if(isset($result)){
//                cache::write($key,$result)
//            return true;
//        }
//    }
}