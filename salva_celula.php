<?php 
require_once('conexao.php');
$cell = $_POST['valor'];
$campo = $_POST['campo'];
$index = $_POST['index'];
$old = $_POST['old'];
// $campo_bd = '';
// /*EXplicação
// Com ajax não precisa do switch case, pois os campos já estão com os mesmos nomes
// sendo assim, nã precisa da variavel campo_bd
// */
// switch ($campo) {
//     case 'data_rascunho':
//         $campo_bd = "data_rascunho";
//         break;
//     case 'dataCerta':
//         $campo_bd = "newdate";
//         break;
//     case 'area':
//         $campo_bd = "data_rascunho";
//         break;
//     case 'proprietarios':
//         $campo_bd = "data_rascunho";
//         break;
//     case 'cadImibiliario':
//         $campo_bd = "cad_imobiliario";
//         break;
//     case 'onus':
//         $campo_bd = "onus_vigente";
//         break;
//     case 'dataNova':
//         $campo_bd = "datanova";
//         break;
//     case 'name':
//         $campo_bd = "nome";
//         break;
//     case 'atosCad':
//         $campo_bd = "atos_cadastrados";
//         break;
//     case 'atosExis':
//         $campo_bd = "atos_existentes";
//         break;
//     case 'duvidas':
//         $campo_bd = "duvidas";
//         break;
//     default:
//         $campo_bd = "ERRo";
//         break;
 
// }

//$salvar = $_REQUEST["action"];
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

 

    //echo json_encode(array('success' => 1));

    echo "DEU CERTO";
    var_dump($index);
    print_r( $cell);
    echo ('<br> CAMPO'); 
    print_r( $campo);
    echo ('<br>');
    print_r( $index);
    echo ('<br> CAMPO BD');
    //print_r( $campo_bd);
    echo ('<br>CAMPO BR');    
    //var_dump($campo_bd);
    echo ('<br>');    
    echo($old);
} else {
    //echo (json_encode(array('succes)s' => 0));
    echo "DEU ERRADO";
    echo $cell;
    echo ('<br>');    
    print_r( $campo);
    echo ('<br>');    
    print_r( $index);
    //print_r( $campo_bd);
    echo ('<br>');    
    print_r($old);
}

