<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 4/9/13
 * Time: 4:15 PM
 * To change this template use File | Settings | File Templates.
 */
App::uses('ErrorLog','Plugin/LogErrors/Model');

class FetchDataTask extends AppShell {

    public function fetch(){
        $errorLog=new ErrorLog();

        $errorLog->virtualFields['total']='COUNT(*)';

        $result=$errorLog->find('list',array(
            'group'=>array(
                'error_type'
            ),
            'fields'=>array(
                'error_type','total'
            )
        ));
        return $result;
    }

}
