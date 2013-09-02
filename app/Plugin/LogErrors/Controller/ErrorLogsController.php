<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 26/8/13
 * Time: 11:04 AM
 * To change this template use File | Settings | File Templates.
 */
App::uses('LogErrorsAppController', 'LogErrors.Controller');
App::import('Vendor','swift_required',array('file'=>'Swift-5.0.1'.DS.'lib'.DS.'swift_required.php'));

class ErrorLogsController extends LogErrorsAppController
{
    public $helpers=array('Paginator','Html','Form');
    public $component=array('memcache');
    public $paginate=array('limit'=>20,'order'=>array('ErrorLog.created'=>'desc'));
    public $lastInsertedId;

    function index($conditionResolved=0){
        ini_set('memory_limit', '256M');
        $this->autoRender=true;
        $errors=$this->paginate('ErrorLog',array('ErrorLog.is_resolved'=>$conditionResolved));
//        if(Cache::read("$this->paginate('ErrorLog',array('ErrorLog.is_resolved'=>$conditionResolved))")){
//            $errors=Cache::read("$this->paginate('ErrorLog',array('ErrorLog.is_resolved'=>$conditionResolved))");
//        }
//        else{
//            $errors=$this->paginate('ErrorLog',array('ErrorLog.is_resolved'=>$conditionResolved));
//            Cache::write("$this->paginate('ErrorLog',array('ErrorLog.is_resolved'=>$conditionResolved))",$errors);
//        }
        foreach($errors as $error){
            $key='ErrorLog'.$error['ErrorLog']['id'];
            Cache::write($key,$error);
        }
        $this->set('errors',$errors);

    }

    function view($id=null){
        if(!empty($id)){
            $key='ErrorLog'.$id;
            $error=Cache::read($key);
            if(empty($error)){
                $error=$this->ErrorLog->findById($id);
            }
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
            $error['ErrorLog']['is_resolved']=$data['is_resolved'];
            $result=$this->ErrorLog->save($data);

            $key='ErrorLog'.$this->ErrorLog->id;
            $this->updateCache($key,$error);
        }

        $this->redirect(array('controller' => 'ErrorLogs', 'action' => 'view',$error['ErrorLog']['id']));
    }

    function addLog($data){
        $this->ErrorLog->create();
        $result=$this->ErrorLog->save($data);
        $this->lastInsertedId=$this->ErrorLog->id;
//        $key='ErrorLog'.$this->ErrorLog->id;
//        $this->updateCache($key,$result);
//        $transport = Swift_SmtpTransport::newInstance('smtp.sendgrid.net', 25)
//            ->setUsername('kvijay')
//            ->setPassword('vijay6186')
//        ;
//        $mailer = Swift_Mailer::newInstance($transport);
//        $body=print_r($data,true);
//        // Create a message
//        if(Configure::read('Email_id')){
//            $dest=Configure::read('Email_id');
//        }else{
//            $dest='priyanka.bhoir@rocketmail.com';
//        }
//        $message = Swift_Message::newInstance("$data[error_message]")
//            ->setFrom(array('priyanka.bhoir@weboniselab.com' => 'priyanka bhoir'))
//            ->setTo(array($dest, $dest => 'priyanka'))
//            ->setBody($body)
//        ;
//
//        // Send the message
//        $result = $mailer->send($message);
    }

    function updateCache($key,$data){
//        $memcache = new Memcache();
//        $memcache->connect('localhost', 11211) or die ("Could not connect");
//        if($memcache->replace($key,$data,false,0)==false){
//            $memcache->set($key,$data,false,0);
//        }
       Cache::write($key,$data);
    }

    function getCache($key){
//        $memcache = new Memcached();
//        $memcache->addServer('localhost',11211) or die ("Could not connect");
        //$error=array();
        $error=Cache::read($key);
        return $error;
    }
}
