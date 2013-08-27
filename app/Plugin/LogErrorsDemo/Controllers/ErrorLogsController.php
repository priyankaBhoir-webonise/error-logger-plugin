<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 26/8/13
 * Time: 11:04 AM
 * To change this template use File | Settings | File Templates.
 */
App::uses('LogErrorsAppController', 'LogErrorsDemo.Controller');
require '/home/webonise/projects/php/apps2013/cakephp/vendor/Swift-5.0.1/lib/swift_required.php';

class ErrorLogsController extends LogErrorsAppController
{
    public $paginate = array(
        'limit' => 2,
    );
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
    function update($data){
        $this->ErrorLog->save($data);
    }
    function index(){
        $errors=$this->ErrorLog->find('first');
//        $errors=$this->paginate();
        $this->autoRender=true;
        $this->set('errors',$errors);
    }
}
