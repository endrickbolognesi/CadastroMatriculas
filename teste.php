<?php
    require_once('conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="node_modules/tabulator-tables/dist/css/tabulator.min.css" rel="stylesheet">
    <link href="node_modules/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/toggle.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="http://oss.sheetjs.com/js-xlsx/xlsx.full.min.js"></script>
    <script type="text/javascript" src="node_modules/tabulator-tables/dist/js/tabulator.js"></script>
    <script type="text/javascript" src="node_modules/moment/min/moment.min.js"></script>
    <script type="text/javascript" src="node_modules/sweetalert2/dist/sweetalert2.min.js"></script>

    <title>Teste</title>
    <style type="text/css">
        #example-table {
            background-color: #ccc;
            border: 1px solid #333;

        }

        /*Theme the header*/
        #example-table .tabulator-header {
            background-color: #333;
            color: #fff;
        }

        #example-table .tabulator-col-content {
            background-color: #333;
            color: #fff;
            border: 2px solid #11590d;
        }

        /*Allow column header names to wrap lines*/
        #example-table .tabulator-header .tabulator-col,
        #example-table .tabulator-header .tabulator-col-row-handle {
            white-space: normal;
        }

        /*Color the table rows*/
        #example-table .tabulator-tableHolder .tabulator-table .tabulator-row {
            color: #fff;
            background-color: #666;
        }

        /*Color even rows*/
        #example-table .tabulator-tableHolder .tabulator-table .tabulator-row:nth-child(even) {
            background-color: #444;
        }
        
    </style>
</head>

<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Pasta 23.201- 23.250</a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation"></button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Início <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Baixar</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="#">PDF</a>
                            <a class="dropdown-item" href="#" id="download-xlsx">Excel/Xlsx</a>
                        </div>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <button type="button" class="btn btn-sm btn-toggle" data-toggle="button" aria-pressed="true"
                        autocomplete="off">
                        <div class="handle"></div>
                    </button>
                    <button class="btn btn-dark ">
                        <i class="fa fa-bell-o" aria-hidden="true"></i>
                        <span class="badge badge-danger">5</span>
                    </button>
                </form>
            </div>
        </nav>

        <div id="example-table"></div>


    </div>
    <script type="text/javascript">
     
   var teste = [
    <?php
    // matricula_id, data_rascunho, newdate, area, proprietarios, cad_imobiliario, onus_vigente, data_conf, datanova, nome, atos_cadastrados, atos_existentes, duvidas 
    $sql = 'SELECT *
        FROM rascunho_cm
        ORDER BY matricula_id';
    $data = $conn->query($sql);
    $data->setFetchMode(PDO::FETCH_ASSOC);
    
    while ($r = $data->fetch()): 
    ?>
    
    {
        id:<?php echo $r['matricula_id'] ?>, 
        //datarasc:"<?php //echo $r['data_rascunho']; ?>",
        dataCerta:"<?php echo $r['newdate']; ?>",
        area:"<?php echo $r['area']; ?>",
        proprietarios:"<?php echo $r['proprietarios']; ?>",
        cadImibiliario:"<?php echo $r['cad_imobiliario']; ?>",
        onus:"<?php echo $r['onus_vigente']; ?>",
        dataNova:"<?php echo $r['datanova']; ?>",
        name:"<?php echo $r['nome']; ?>", 
        atosCad:"<?php echo $r['atos_cadastrados']; ?>",
        atosExis:"<?php echo $r['atos_existentes']; ?>",
        duvidas:"<?php echo $r['duvidas']; ?>",
        
    },  
    <?php endwhile; ?>
];

var dateEditor = function(cell, onRendered, success, cancel){

    var cellValue = moment(cell.getValue(), "DD/MM/YYYY").format("YYYY-MM-DD"),
    input = document.createElement("input");

    input.setAttribute("type", "date");

    input.style.padding = "4px";
    input.style.width = "100%";
    input.style.boxSizing = "border-box";

    input.value = cellValue;

    onRendered(function(){
        input.focus();
        input.style.height = "100%";
    });

    function onChange(){
        if(input.value != cellValue){
            success(moment(input.value, "YYYY-MM-DD").format("DD/MM/YYYY"));
        }else{
            cancel();
        }
    }

    input.addEventListener("blur", onChange);

    input.addEventListener("keydown", function(e){
        if(e.keyCode == 13){
            onChange();
        }

        if(e.keyCode == 27){
            cancel();
        }
    });

    return input;
};

    
      
    var table = new Tabulator("#example-table", {
    data:teste,
    height:"800px",
    layout:"fitColumns",
    responsiveLayout:true,
    pagination:"local",
    paginationSize:50,
    paginationSizeSelector:[10, 50, 100, 200],
    
    //persistenceMode: true,
    columns:[
        {title:"Matricula", field:"id", width:100, frozen:true},
        {title:"Nome", field:"name", width:100, editor:true},
        //{title:"Data", field:"datarasc", editor:true},
        {title:"Data Certa F", field:"dataCerta", editor:true, formatter:"datetime", formatterParams:{
            inputFormat:"YYYY-MM-DD",
            outputFormat:"DD/MM/YYYY",
            invalidPlaceholder:"(Data inválida)",
        }},
        {title:"Area", field:"area", editor:true},
        {title:"Proprietarios", field:"proprietarios", editor:true},
        {title:"Cadastro Imobiliario", field:"cadImibiliario", editor:true},
        {title:"Ônus", field:"onus", editor:true},
        {title:"DataConf", field:"dataNova", editor:true, formatter:"datetime", formatterParams:{
            inputFormat:"YYYY-MM-DD",
            outputFormat:"DD/MM/YYYY",
            invalidPlaceholder:"(Data inválida)",
        }},
        {title:"Atos Cadastrados", field:"atosCad", editor:true},
        {title:"Atos Existentes", field:"atosExis", editor:true},
        {title:"Dúvidas", field:"duvidas", editor:true},
    ],
    
    cellEdited:function(cell){
        // This callback is called any time a cell is edited.
        $.ajax({
        url: "salva_celula.php",
        data: {valor: cell.getValue(), campo: cell.getField(), index: cell.getRow().getIndex(), old: cell.getOldValue()},
        // getField <<<<<<<<<<<<<<<<<
        
        type: "post",
        beforeSend : function () {
         console.log('Carregando...');
        },
        success: function(response, textStatus, xhr){
            //alert("AJAX result: " + response + "; status: " + textStatus);
            Swal.fire({
            type: 'success',
            title: 'Enviado',
            text: 'AJAX result: ' + response + '; status: ' + textStatus,
            })
            
        },
        error: function(XMLHttpRequest, textStatus, error){
            //alert("AJAX error: " + textStatus + "; " + error);
            Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'AJAX error: ' + textStatus + '; ' + error,
            })
        }
        })
    },
});

$("#download-xlsx").click(function(){
    table.download("xlsx", "data.xlsx", {sheetName:"teste"});
});


    </script>
    
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</html>