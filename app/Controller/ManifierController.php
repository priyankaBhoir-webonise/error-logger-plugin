<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 2/9/13
 * Time: 4:29 PM
 * To change this template use File | Settings | File Templates.
 */
App::uses('AppController', 'Controller');
class ManifierController extends AppController {

    public $helper=array('form','html');

    function index(){
        $file=fopen('/webroot/bootstrap.css','w');
        $css_code=fread($file,10);
        $result = YAHOO.compressor.cssmin(input_css_code);
    }
}
