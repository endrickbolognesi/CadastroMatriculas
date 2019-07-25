<?php 
require_once('conexao.php');
$cell = $_POST['valor'];
$campo = $_POST['campo'];
$index = $_POST['index'];
$old = $_POST['old'];

if (!empty($cell) OR !empty($old) ) {
    try{
    $inserir = "UPDATE rascunho_cm SET ".$campo."='$cell' WHERE matricula_id ='$index' "; //&& $campo_bd='$campo'
    $stmt = $conn->prepare($inserir);
    $stmt->execute();
    echo ($stmt->rowCount()) . " records UPDATED successfully";
    }
    catch(PDOException $e)
    {
    echo $inserir . "<br>" . $e->getMessage();
    }

$conn = null;


} else {

}

