<?php
/**
 * Created by PhpStorm.
 * User: UdHaY
 * Date: 08-Jul-16
 * Time: 11:16 PM
 */

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/conn.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

    $amqp = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
    $channel = $amqp->channel();

    $channel->queue_declare('msg_queue', false, true, false, false);

    $task = function($msg){

        echo " Message Recieved ". "\n";

        $data = json_decode($msg->body,true);

        $conn = Conn::getConn();

        $query = "insert into msg values('".$data['name']."','".$data['email']."','".$data['phone']."')";

        if(mysqli_query($conn,$query)){

            $json = "queue.json";
            if (!file_exists($json)) {
                file_put_contents($json, '[]');
            }

            $buffer = file_get_contents($json);
            $current = json_decode($buffer);
            array_push($current, $data);
            $updated = json_encode($current);
            file_put_contents($json, $updated);

            echo " Message Processed ". "\n";
        }

        $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
    };

    $channel->basic_qos(null, 1, null);
    $channel->basic_consume('msg_queue', '', false, false, false, false, $task);

    while(count($channel->callbacks)) {
        $channel->wait();
    }

    $channel->close();
    $amqp->close();

?>