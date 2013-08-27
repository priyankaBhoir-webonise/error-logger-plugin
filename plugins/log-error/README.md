Error-Logger
=============


Configurations
===============

app/Config/bootstrap.php
=========================
add following lines
```CakePlugin::load('log-error');
App::uses('ErrorCheck','log-error.libs');
```
app/Config/core.php
=========================
```Configure::write('Error', array(
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
optional configurations :
```
Configure::write('Error_log_file', 'path/to/your/log');
```
database
==============
In your database you need to add new table with following scema
```
CREATE TABLE `error_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `error_message` text NOT NULL,
  `error_type` int(11) NOT NULL,
  `error_stack` text NOT NULL,
  `session_data` text NOT NULL,
  `server_data` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
)
```