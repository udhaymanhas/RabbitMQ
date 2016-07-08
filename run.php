<?php
/**
 * Created by PhpStorm.
 * User: UdHaY
 * Date: 08-Jul-16
 * Time: 11:51 PM
 */
require_once __DIR__ . '/send.php';

    $data = implode(' ', array_slice($argv, 1));

    if(empty($data))
    {
        $name = "default";
        $email = "default";
        $phone = "default";
    }
    else
    {
        $name = $argv[1];
        $email = $argv[2];
        $phone = $argv[3];
    }

    $sendMessage = new Send();

    if($sendMessage->queueAssignment($name, $email, $phone))
        echo "Message Sent - QUEUED\n";
    else
        echo "Message Sent - FAILED"

?>