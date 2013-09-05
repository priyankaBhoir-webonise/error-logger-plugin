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

            $email = Configure::read('enableEmail');
        if ($email['enable']==1) {

            $interval=$email['interval']['hours'];
            $data = $this->FetchData->fetch($interval);

            $transport = Swift_SmtpTransport::newInstance($email['host'], $email['port'])
                ->setUsername($email['username'])
                ->setPassword($email['password']);
            $mailer = Swift_Mailer::newInstance($transport);

            // Create a message
            $message = Swift_Message::newInstance("Error Log updates")
                ->setFrom(array($email['sender_email'] => $email['sender_name']))
                ->setTo(array($email['receiver_email'],$email['sender_email'] => $email['sender_name']))
                ->setBody($data,'text/html');

            // Send the message
            $result = $mailer->send($message);
        }
    }
}
