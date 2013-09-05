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

    public function fetch($interval){
        $errorLog=new ErrorLog();

        $errorLog->virtualFields['total']='COUNT(*)';

        $result=$errorLog->find('list',array(
            'group'=>array(
                'error_type'
            ),
            'fields'=>array(
                'error_type','total'
            ),
            'conditions'=>array(
                'TIMESTAMPDIFF(HOUR,created,NOW()) <'=>$interval
            )
        ));
        if(empty($result)){
            $dataToSend="No Error in last $interval hours\n";
        }
        else{
            $dataToSend='';
            foreach($result as $key=>$value){
                $dataToSend.="The Error of type [<b> $key </b> ] is occured $value times in last $interval hours <br>";
            }
        }
        return $dataToSend;
    }

}
