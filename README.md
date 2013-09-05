
error-logger-plugin
===================

Configurations 
====================
Add following lines in app/Config/bootstrap.php
```
CakePlugin::load('LogErrors');
App::uses('ErrorCheck','LogErrors.Lib');
```

Add following lines in app/Config/core.php
```
Configure::write('Error', array(
    'handler' => 'ErrorCheck::onError',
    'level' => E_ALL & ~E_DEPRECATED,
    'trace' => true
));

Configure::write('Exception', array(
    'handler' => 'ErrorCheck::onException',
    'renderer' => 'ExceptionRenderer',
    'log' => true
));
```
optional configuration to add in the core.php
```
Configure::write('Error_log_file','path/to/log file');
Configure::write('enableEmail',array(
        'enable'=>'1',
        'receiver'=>'priyanka.bhoir@weboniselab.com',
        'interval'=>array('hours'=>'48')

));
```

-- receiver in the configurations should be valid email id to which all errors will be reported(mailed)
