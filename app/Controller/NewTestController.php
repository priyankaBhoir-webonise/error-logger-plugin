<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 27/8/13
 * Time: 2:56 PM
 * To change this template use File | Settings | File Templates.
 */
App::uses('ErrorLogsController','LogErrorsDemo.Controllers');

class NewTestController extends ErrorLogsController
{

    function index(){
        $this->render('ErrorLogsController');
    }
}
