<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 22/8/13
 * Time: 4:30 PM
 * To change this template use File | Settings | File Templates.
 */
App::uses('ErrorLogsController','log-error.controllers');

class ErrorCheck extends ErrorHandler{
    public static $errorLog=null;
    public static $instance=null;

    static function getLog(){
        if(empty(self::$errorLog)){
            self::$errorLog=new ErrorLogsController();
        }
        return (self::$errorLog);
    }
    static function getInstance(){
        if(empty(self::$instance)){
            self::$instance=new self();
        }
    }

    function addErrorLog($data){
        $serverData=array('HTTP_HOST','HTTP_USER_AGENT','HTTP_COOKIE','REMOTE_ADDR','REQUEST_METHOD','QUERY_STRING','REQUEST_URI','REQUEST_TIME');
        $errorLog= ErrorCheck::getLog();
        if(!empty($_SESSION)){
            $data['session_data']=print_r($_SESSION,true);
        }
        if(!empty($_SERVER)){
            $data['server_data']='';
            foreach($_SERVER as $key=>$value){
                if(in_array($key,$serverData)){
                    $data['server_data'].="[$key]=>$value\n";
                }
            }
        }
        $errorLog->addLog($data);
    }

    public function onError($type, $message, $file = null, $line = null, $context = null,$x=null){
        self::getInstance();
        if(Configure::read('Error_log_file')){
            $err_file=Configure::read('Error_log_file');
        }else{
            $err_file=APP.'tmp'.DS.'logs'.DS.'custom-error.log';
        }
        error_log("Error:$message  type:$type \nstack: \n",3,$err_file);

        $backtrace=debug_backtrace();
        $error_message='';
        foreach($backtrace as $trace){
           if(!empty($trace['file'])){
               $error_message.="File:".$trace['file'].":".$trace['line']." \n";
           }
        }
        error_log($error_message,3,$err_file);
        $data=array('error_message'=>$message,'error_type'=>$type,'error_stack'=>$error_message);
        self::$instance->addErrorLog($data);

        parent::handleError($type, $message, $file, $line, $context);
    }

    public function onException(Exception $e){
        self::getInstance();
        if(Configure::read('Error_log_file')){
            $err_file=Configure::read('Error_log_file');
        }else{
            $err_file=APP.'tmp'.DS.'logs'.DS.'custom-error.log';
        }
        error_log("\nError:".$e->getMessage()."  code:".$e->getCode()." \n",3,$err_file);
        $backtrace=debug_backtrace();
        $error_message='';
        foreach($backtrace as $trace){
            if(!empty($trace['file'])){
                $error_message.="\nFile:".$trace['file'].":".$trace['line']." \n";
                error_log($error_message,3,$err_file);
            }
        }

        $data=array('err_message'=>$e->getMessage(),'err_type'=>$e->getCode(),'err_stack'=>$error_message);
        self::$instance->addErrorLog($data);

        parent::handleException($e);
    }

}