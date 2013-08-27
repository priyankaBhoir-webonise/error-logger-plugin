<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 23/8/13
 * Time: 11:00 AM
 * To change this template use File | Settings | File Templates.
 */
class PeopleController extends AppController{
//    public $ModelClass="Person";
//    public $modelclass="Person";
    public $name="Person";
    function index(){
        $people=$this->Person->find('all');
        $this->autoRender=false;
        return $people;
    }
}