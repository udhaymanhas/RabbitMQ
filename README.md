# RabbitMQ + PHP
RabbitMQ + PHP Basic Application | Message Queuing

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
  Recieves data and processes it under callback $task (updates db and JSON in this example)
  
  
### conn.php
  Database config (mysql)
  
  
### run.php  
  uses function queueAssignment($name, $email, $phone) to send data(via CLI)

### msg_db.sql
  import this file in mysql to get a test db(msg_db) and a test table(msg)

** This is just a demo code. No validation/authentication has been done.
