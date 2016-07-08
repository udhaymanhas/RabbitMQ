# RabbitMQ + PHP
RabbitMQ + PHP | Basic Application | Message Queueing

### Files:
* composer.json
* run.php 
* send.php (producer)
* recieve.php (consumer)
* conn.php (db-config)
* msg_db.sql (mysql exported db)
  

### RabbitMQ Installation (windows):
  https://www.rabbitmq.com/install-windows.html
  install Erlang Windows Binary File
  install RabbitMQ Server

### Dependency installation :
  run command 'composer install' or 'php composer.phar  install' in the project directory
  
  
### send.php (producer)
  use public function queueAssignment($name, $email, $phone) to send data
  
  
### reciever.php (consumer)
  Recieves data and processes it under callback $task (updates db and JSON (queue.json) in this example)
  
  
### conn.php
  Database config (mysql)
  
  
### run.php  
  uses function queueAssignment($name, $email, $phone) to send data(via CLI)

### msg_db.sql
  import this file in mysql to get a test db(msg_db) and a test table(msg)

## Running the Project
  * Start the RabbitMQ server 
  * On one terminal(cmd) Run message reciver using command 'php reciever.php'
  * On another terminal(cmd) Send message as arguments with command 'php send.php john johndoe@mail.com 9999999999'
  
  * Edit file run.php to alter sending data to queueAssignment($name, $email, $phone).
  * Edit callback function $task in recieve.php to handle recieved data.
  * Edit file conn.php to update respective database credentials.


***** This is just a demo code. No validation/authentication has been done.
