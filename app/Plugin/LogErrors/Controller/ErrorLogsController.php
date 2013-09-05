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
        /*
         * tring to cache the paginator
         *
         */
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

    /**
     * @param null $id
     */
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

    /**
     * @param null $id
     */
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
            Cache::write($key,$error);
        }

        $this->redirect(array('controller' => 'ErrorLogs', 'action' => 'view',$error['ErrorLog']['id']));
    }

    function addLog($data){
        $this->ErrorLog->create();
        $result=$this->ErrorLog->save($data);
        $this->lastInsertedId=$this->ErrorLog->id;
    }

}
