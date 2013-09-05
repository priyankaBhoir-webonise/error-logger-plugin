<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 4/9/13
 * Time: 3:59 PM
 * To change this template use File | Settings | File Templates.
 */
App::import('Vendor', 'swift_required', array('file' => 'Swift-5.0.1' . DS . 'lib' . DS . 'swift_required.php'));

class SendMailShell extends AppShell
{
    public $tasks = array('FetchData');

    public function main()
    {
        if (Configure::read('enableEmail')) {
            $email = Configure::read('enableEmail');
            $destination = $email['receiver'];
            $interval=$email['interval']['hours'];
            $data = $this->FetchData->fetch($interval);

            $transport = Swift_SmtpTransport::newInstance('smtp.sendgrid.net', 25)
                ->setUsername('kvijay')
                ->setPassword('vijay6186');
            $mailer = Swift_Mailer::newInstance($transport);

            // Create a message
            $message = Swift_Message::newInstance("Error Log updates")
                ->setFrom(array('priyanka.bhoir@weboniselab.com' => 'priyanka bhoir'))
                ->setTo(array($destination, $destination => 'priyanka'))
                ->setBody($data,'text/html');

            // Send the message
            $result = $mailer->send($message);
        }
    }
}
