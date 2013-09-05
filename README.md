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
        'receiver'=>'username@example.com',
        'interval'=>array('hours'=>'5')

));
```

-- receiver in the configurations should be valid email id to which all errors will be reported(mailed)

Database :
==========
create table as :
```
CREATE TABLE IF NOT EXISTS `error_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `error_message` text NOT NULL,
  `error_type` varchar(150) NOT NULL,
  `error_stack` text NOT NULL,
  `session_data` text NOT NULL,
  `server_data` text NOT NULL,
  `created` datetime NOT NULL,
  `is_resolved` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
)
```
