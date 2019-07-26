<?php 
require 'init.php';

$id   = $_POST['id'];


$conn = db_connect();
  

     $sql = "delete from users where id = ".$id;   
     $stm = $conn->prepare($sql);   
     $stm->execute();   



