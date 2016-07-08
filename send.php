<?php
/**
 * Created by PhpStorm.
 * User: UdHaY
 * Date: 08-Jul-16
 * Time: 11:16 PM
 */

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Send
{
    public static function queueAssignment($name, $email, $phone)
    {
        $amqp = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $amqp->channel();

        $channel->queue_declare('msg_queue', false, true, false, false);

        $data = array(
            "name"=>$name,
            "email"=>$email,
            "phone"=>$phone
            );

        $data_json = json_encode($data);

        $msg = new AMQPMessage($data_json,
            array('delivery_mode' => 2)
        );

        $channel->basic_publish($msg, '', 'msg_queue');

        $channel->close();
        $amqp->close();

        return true;
    }
}

?>