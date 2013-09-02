<?php
set_error_handler('myErrorHandler','E_ALL');

function myErrorHandler($type, $message, $file = null, $line = null, $context = null){
    $logFile=fopen('new.txt','w');
    fwrite($logFile,'$message');
    fclose($logFile);
    echo 'Error Occured';
}