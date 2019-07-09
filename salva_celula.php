<?php 
require_once('conexao.php');
$cell = $_POST['valor'];
$campo = $_POST['campo'];
$index = $_POST['index'];
$campo_bd = '';

switch ($campo) {
    case 'data_rascunho':
        $campo_bd = "data_rascunho";
        break;
    case 'dataCerta':
        $campo_bd = "newdate";
        break;
    case 'area':
        $campo_bd = "data_rascunho";
        break;
    case 'proprietarios':
        $campo_bd = "data_rascunho";
        break;
    case 'cadImibiliario':
        $campo_bd = "cad_imobiliario";
        break;
    case 'onus':
        $campo_bd = "onus_vigente";
        break;
    case 'dataNova':
        $campo_bd = "datanova";
        break;
    case 'name':
        $campo_bd = "nome";
        break;
    case 'atosCad':
        $campo_bd = "atos_cadastrados";
        break;
    case 'atosExis':
        $campo_bd = "atos_existentes";
        break;
    case 'duvidas':
        $campo_bd = "duvidas";
        break;
 
}
//$salvar = $_REQUEST["action"];
if (!empty($cell)) {
    try{
    $inserir = "UPDATE rascunho_cm SET ".$campo_bd."='$cell' WHERE matricula_id ='$index' "; //&& $campo_bd='$campo'
    $stmt = $conn->prepare($inserir);
    $stmt->execute();
    echo $stmt->rowCount() . " records UPDATED successfully";
    echo $stmt->rowCount() . " records UPDATED successfully";
    }
    catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;



    echo json_encode(array('success' => 1));
    print_r( $cell);
    echo '/';
    print_r( $campo);
    echo '/';
    print_r( $index);
    echo '/';
    print_r( $campo_bd);
    echo '/';    
    var_dump($campo_bd);
} else {
    echo json_encode(array('success' => 0));
    echo $cell;
    print_r( $campo);
    print_r( $index);
    print_r( $campo_bd);
}

