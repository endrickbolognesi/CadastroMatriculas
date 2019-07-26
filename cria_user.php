<?php 
require 'init.php';

$nome = $_POST['nome'];
$senha = make_hash($_POST['senha']);
$login = $_POST['login'];
$tipo = $_POST['tipo'];
$id = '';


$conn = db_connect();
  
  if (!empty($nome) && !empty($senha) && !empty($login)&& !empty($tipo)):   
    try{   
     $sql = "INSERT INTO users (name, password, login, fknivel) VALUES (?, ?, ?, ?)";   
     $stm = $conn->prepare($sql);   
     $stm->bindValue(1, $nome);   
     $stm->bindValue(2, $senha);   
     $stm->bindValue(3, $login);   
     $stm->bindValue(4, $tipo);
     $stm->execute();   
     //echo "<script>alert('Registro inserido com sucesso ')</script>";   
    
    }catch(PDOException $erro){   
     echo "<script>alert('Erro na linha: {$erro->getMessage()}')</script>"; 
         echo "DEU errado";
    echo "DEU CERTO";
    var_dump($nome);
    echo (' '); 
    print_r( $senha);
    echo (' '); 
    print_r( $login);
    echo (' ');
    print_r( $tipo);
    }   
   endif;  
// if (!empty($cell) OR !empty($old) ) {
//     try{
//     $inserir = "UPDATE rascunho_cm SET ".$campo."='$cell' WHERE matricula_id ='$index' "; //&& $campo_bd='$campo'
//     $stmt = $conn->prepare($inserir);
//     $stmt->execute();
//     echo ($stmt->rowCount()) . " records UPDATED successfully";
//     }
//     catch(PDOException $e)
//     {
//     echo $inserir . "<br>" . $e->getMessage();
//     }

// $conn = null;


// } else {

// }

