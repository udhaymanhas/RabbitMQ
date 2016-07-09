<?php
/**
 * Created by PhpStorm.
 * User: UdHaY
 * Date: 08-Jul-16
 * Time: 11:16 PM
 */

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection; // PHP lib to communicate with RabbitMQ Server
use PhpAmqpLib\Message\AMQPMessage;

class Send
{
    public static function queueAssignment($name, $email, $phone)
    {
        $amqp = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest'); //connect to RabbitMQ Server
        $channel = $amqp->channel(); // create a channel to send data

        $channel->queue_declare('msg_queue', false, true, false, false); // create a queue if it doesn't exits already

        $data = array(
            "name"=>$name,
            "email"=>$email,
            "phone"=>$phone
            );

        $data_json = json_encode($data);

        $msg = new AMQPMessage($data_json, //create AMQPMessage
            array('delivery_mode' => 2) //Message will not be lost
        );

        if($channel->basic_publish($msg, '', 'msg_queue') == '') //publish or queue the message on RabbitMQ server
        {
            return true;
        }
        else
        {
            return false;
        }

        $channel->close();
        $amqp->close();

    }
}

?>