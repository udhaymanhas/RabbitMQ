<?php
/**
 * Created by PhpStorm.
 * User: UdHaY
 * Date: 09-Jul-16
 * Time: 12:13 AM
 */
class Conn{

    public static function getConn(){

        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'msg_db';

        $con = mysqli_connect($host,$username,$password,$database); //CONNECTION
        return $con;
    }
}

?>

