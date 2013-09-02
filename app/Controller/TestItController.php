<?php


//require_once '/home/webonise/projects/php/apps2013/cakephp/vendor/airbrake/airbrake-php/src/Airbrake/Client.php';
//require_once '/home/webonise/projects/php/apps2013/cakephp/vendor/airbrake/airbrake-php/src/Airbrake/Configuration.php';
//require_once '/home/webonise/projects/php/apps2013/cakephp/vendor/airbrake/airbrake-php/src/Airbrake/EventHandler.php';
//CakePlugin::load('people');
//CakePlugin::load('LogErrors');
//App::uses('ErrorCheckController','LogErrorsDemo.Controllers');
//App::uses('PeopleController','people.Controllers');

App::uses('ErrorLogsController','LogErrors.Controller');
class TestItController extends AppController{

    public function custom(){

        //$p=new PeopleController();
//        $people=$p->index();
//        print_r($people);
//        $er=new ErrorCheckController();
//        $er->setHandler();

         Airbrake\EventHandler::start('0fe5a382cc8dacb1083ec2f926f07eeb');
        $apiKey  = '0fe5a382cc8dacb1083ec2f926f07eeb '; // This is required
        $options = array(); // This is optional

        $config = new Airbrake\Configuration($apiKey, $options);
        $client = new Airbrake\Client($config);

// Send just an error message
        //$result=$client->notifyOnError('My error message');
//        if ($this->request->is('post')){
//            $name=$_POST['name'];
//            $result .='name = '.$name;
//        }
//        $res=5/0;

// Send an exception that may have been generated or caught.
        //throw new Exception('not cought');
        try {
            throw new Exception('This is my exception');

        } catch (Exception $exception) {
           $result=$client->notifyOnException($exception);
        }
       // $this->autoRender=true;
      $this->set('result',$people);
    }

    public function customization(){
        set_error_handler(array($this,'onError'));
        $res=5/0;
        set_error_handler(array($this,'onError2'));
        $res=5/0;
    }

    function onError($type, $message, $file = null, $line = null, $context = null){
        $fp=fopen('new.txt','w');
        fwrite($fp,$message);
        fclose($fp);
        parent::handleError($type, $message, $file, $line, $context);
    }
    function onError2($type, $message, $file = null, $line = null, $context = null){
        $fp=fopen('new2.txt','w');
        fwrite($fp,'In Error2 function');
        fwrite($fp,$message);
        fclose($fp);
    }

    public function index(){
//        $_SESSION['name']='priyanka';
          $res=5/0;
////        include('abcd.txt');
//        //throw new Exception('exception demo');
//        $this->autoRender=false;
//        $err=new ErrorLogsController();
//        $err->autoRender=true;
//        $err->index();

    }
}
