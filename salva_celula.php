<?php 
require_once('conexao.php');
$cell = $_POST['valor'];
$campo = $_POST['campo'];
$index = $_POST['index'];
$campo_bd ='';
switch ($campo) {
    case $campo == 'data_rascunho':
        $campo_bd = $campo;
        break;
    case $campo == 'newdate':
        $campo_bd = $campo;
        break;
    case $campo == 'area':
        $campo_bd = $campo;
        break;
    case $campo == 'proprietarios':
        $campo_bd = $campo;
        break;
    case $campo == 'cad_imobiliario':
        $campo_bd = $campo;
        break;
    case $campo == 'onus_vigente':
        $campo_bd = $campo;
        break;
    case $campo == 'data_conf':
        $campo_bd = $campo;
        break;
    case $campo == 'datanova':
        $campo_bd = $campo;
        break;
    case $campo == 'nome':
        $campo_bd = $campo;
        break;
    case $campo == 'atos_cadastrados':
        $campo_bd = $campo;
        break;
    case $campo == 'atos_existentes':
        $campo_bd = $campo;
        break;
    case $campo == 'duvidas':
        $campo_bd = $campo;
        break;
 
}
//$salvar = $_REQUEST["action"];
if (!empty($cell)) {
    //$inserir = "UPDATE rascunho_cm SET matricula_id='$valor',  $campo_bd='$campo' WHERE matricula_id ='$index'";

    echo json_encode(array('success' => 1));
    print_r( $cell);
    echo '</br>';
    print_r( $campo);
    echo '</br>';
    print_r( $index);
    echo '</br>';
    print_r( $campo_bd);
} else {
    echo json_encode(array('success' => 0));
    echo $cell;
    print_r( $campo);
    print_r( $index);
    print_r( $campo_bd);
}

