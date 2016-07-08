# RabbitMQ + PHP
RabbitMQ + PHP Basic Application | Message Queuing

### Files:
* composer.json
* run.php 
* send.php (producer)
* recieve.php (consumer)
* conn.php (db-config)
  

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
