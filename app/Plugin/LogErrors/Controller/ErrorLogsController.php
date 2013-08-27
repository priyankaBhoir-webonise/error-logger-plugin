<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 26/8/13
 * Time: 11:04 AM
 * To change this template use File | Settings | File Templates.
 */
App::uses('LogErrorsAppController', 'LogErrors.Controller');
require '/home/webonise/projects/php/apps2013/cakephp/vendor/Swift-5.0.1/lib/swift_required.php';

class ErrorLogsController extends LogErrorsAppController
{
    public $helpers=array('Paginator','Html','Form');
    public $paginate=array('limit'=>20,'order'=>array('ErrorLog.created'=>'desc'));


    function index($conditionResolved=0){
        $errors=$this->paginate('ErrorLog',array('ErrorLog.is_resolved'=>$conditionResolved));
        $this->autoRender=true;
        $this->set('errors',$errors);
    }

    function view($id=null){
        if(!empty($id)){
            $error=$this->ErrorLog->findById($id);
            $this->set('error',$error);
        }
    }
    function change($id=null){
        if(!empty($id)){
            $error=$this->ErrorLog->findById($id);
        }
        if(!empty($error['ErrorLog']['id'])){
            $data=array();
            $data['id']=$error['ErrorLog']['id'];
            $data['is_resolved']=($error['ErrorLog']['is_resolved']==0)?1:0;
            $this->ErrorLog->save($data);
        }

        $this->redirect(array('controller' => 'ErrorLogs', 'action' => 'view',$error['ErrorLog']['id']));
    }

    function addLog($data){
        $this->ErrorLog->create();
        $result=$this->ErrorLog->save($data);

//        $transport = Swift_SmtpTransport::newInstance('smtp.sendgrid.net', 25)
//            ->setUsername('kvijay')
//            ->setPassword('vijay6186')
//        ;
//        $mailer = Swift_Mailer::newInstance($transport);
//        $body=print_r($data,true);
//        // Create a message
//        $message = Swift_Message::newInstance("$data[error_message]")
//            ->setFrom(array('priyanka.bhoir@weboniselab.com' => 'priyanka bhoir'))
//            ->setTo(array('priyanka.bhoir@weboniselab.com', 'priyanka.bhoir@weboniselab.com' => 'priyanka'))
//            ->setBody($body)
//        ;
//
//        // Send the message
//        $result = $mailer->send($message);
    }
}
