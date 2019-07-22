<?php
    require_once('conexao.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="semantic/semantic.min.css">
    <link href="node_modules/tabulator-tables/dist/css/tabulator.min.css" rel="stylesheet">
    <link href="node_modules/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="semantic/semantic.js"></script>
    <script type="text/javascript" src="http://oss.sheetjs.com/js-xlsx/xlsx.full.min.js"></script>
    <script type="text/javascript" src="node_modules/tabulator-tables/dist/js/tabulator.js"></script>
    <script type="text/javascript" src="node_modules/moment/min/moment.min.js"></script>
    <script type="text/javascript" src="node_modules/sweetalert2/dist/sweetalert2.min.js"></script>

    <title>Cadastro</title>
</head>

<body>
  <div class="pusher">
    <div class="ui top inverted  menu asd marginlefting borderless"
      style="border-radius: 0!important; border: 0; margin-left: 260px; -webkit-transition-duration: 0.1s;">
      <a class="item openbtn">
        <i class="icon content"></i>
      </a>
      <a class="mav red item" href="cadastro.php">Cadastro</a>
      <a class="mav blue item" href="conferencia.php" >Conferência</a>
      <a class="mav orange item" href="horas.php">Planilha de horas</a>

      <div class="right menu">
        <div class="item">
        
          <div class="ui fitted toggle checkbox">
            <input type="checkbox" tabindex="0" class="hidden darkmode">
          </div>

        </div>

        <div class="ui dropdown item ">
          <!-- <img class="ui avatar image" src="img/square-image.png"> -->
          <span>Usuário</span>
          <i class="dropdown icon"></i>
          <div class="menu">
            <a class="item">Configurações</a>
            <a class="item"><i class="power off icon red"></i>Sair</a>
          </div>
        </div>
        <!-- <div class="item">
        <div class="ui red button">Sair</div>
      </div> -->
      </div>
    </div>
  </div>
<!-- ui bottom attached segment sidebar -->
<div class="ui inverted sidebar very thin icon vertical left menu overlay visible  ">
 
  
</div>
<div class="ui fluid container">


</div>
<div id="example-table" class="marginlefting asd" style="border-radius: 0!important; border: 0; margin-left: 260px; -webkit-transition-duration: 0.1s;"></div>

<script>
  $(".openbtn").on("click", function() {
  $(".ui.sidebar").toggleClass("very thin icon");
  $(".asd").toggleClass("marginlefting");
  $(".sidebar z").toggleClass("displaynone");
  $(".ui.accordion").toggleClass("displaynone");
  $(".ui.dropdown.item").toggleClass("displayblock");
  $(".logo").find('img').toggle();

 })
 // using context
$('.context.example .ui.sidebar').sidebar({
    context: $('.context.example .bottom.segment')
  })
  .sidebar('attach events', '.context.example .menu .item')
;
 $(".ui.dropdown").dropdown({
   allowCategorySelection: true,
   transition: "fade up",
   //context: 'sidebar',
   on: "hover"
 });
;

$('.ui.checkbox').checkbox().on("click", function(){
  $(".ui.menu").toggleClass("inverted");
  $(".ui.accordion .title:not(.ui)").toggleClass("inverteCor");
  background-color: rgba(0,0,0,.05);
    color: rgba(245, 245, 245, 0.95);
  
});


$(".mav").on("click", function(){
  $(".mav").removeClass("active");
  $(this).toggleClass("active"); 
})

 $('.ui.accordion').accordion({
   selector: {

   }
 });
</script>
<script type="text/javascript">
     
     var teste = [
      <?php
      $sql = 'SELECT *
          FROM rascunho_cm
          ORDER BY matricula_id';
      $data = $conn->query($sql);
      $data->setFetchMode(PDO::FETCH_ASSOC);
      
      while ($r = $data->fetch()): 
      ?>
      
      {
          id:<?php echo $r['matricula_id'] ?>,
          dataCerta:"<?php echo $r['newdate']; ?>",
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
        selectable:true,
        selectable:5,
      selectableRollingSelection:false,
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
          {title:"Nome", field:"name", width:100,editor:true},
          {title:"Data Certa F", field:"dataCerta", formatter:"datetime",editor:true, formatterParams:{
              inputFormat:"YYYY-MM-DD",
              outputFormat:"DD/MM/YYYY",
              invalidPlaceholder:"(Data inválida)",
          }},
          {title:"Atos Cadastrados", field:"atosCad",editor:true},
          {title:"Atos Existentes", field:"atosExis",editor:true},
          {title:"Dúvidas", field:"duvidas",editor:true},
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
</body>
</html>