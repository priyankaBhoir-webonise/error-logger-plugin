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
    public $actsAs = array('Search.Searchable');
    public $filterArgs = array(
        'title' => array('type' => 'like')
        );
    public $belongsTo='User';

    public function isOwnedBy($post, $user) {
        return $this->field('id', array('id' => $post, 'user_id' => $user)) === $post;
    }
}