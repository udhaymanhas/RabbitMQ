<?php
/**
 * Created by PhpStorm.
 * User: UdHaY
 * Date: 08-Jul-16
 * Time: 11:16 PM
 */

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/conn.php';
use PhpAmqpLib\Connection\AMQPStreamConnection; // PHP lib to communicate with RabbitMQ Server

    $amqp = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest'); //connect to RabbitMQ Server
    $channel = $amqp->channel();

    $channel->queue_declare('msg_queue', false, true, false, false);  // create a queue if it doesn't exits already, if it exists listen to it

    $task = function($msg){

        echo " Message Recieved ". "\n";

        $data = json_decode($msg->body,true); //Receive the message in $msg->body

        $conn = Conn::getConn(); //get database connection

        $query = "insert into msg values('".$data['name']."','".$data['email']."','".$data['phone']."')";

        if(mysqli_query($conn,$query)){

            $json = "queue.json";
            if (!file_exists($json)) {
                file_put_contents($json, '[]');
            }

            $buffer = file_get_contents($json);
            $current = json_decode($buffer);
            array_push($current, $data); //append new data
            $updated = json_encode($current);
            file_put_contents($json, $updated);

            echo " Message Processed ". "\n";
        }

        $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']); // Send acknowledgement back to the server
    };

    $channel->basic_qos(null, 1, null); // for fair dispatch
    $channel->basic_consume('msg_queue', '', false, false, false, false, $task); // Consume/get messages from RabbitMQ server and then pass it to a callback ($task) for processing

    while(count($channel->callbacks)) { //keep listening for messages
        $channel->wait();
    }

    $channel->close();
    $amqp->close();

?>