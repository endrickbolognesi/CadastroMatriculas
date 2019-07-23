<?php
session_start();
//require_once('conexao.php');

require 'init.php';
require 'check.php';
?>
    

<?php include'header.html' ?>

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
  
});


$(".mav").on("click", function(){
  $(".mav").removeClass("active");
  $(this).toggleClass("active"); 
})

 $('.ui.accordion').accordion({
   selector: {

   }
 });

     
     var teste = [
      <?php
      $conn = db_connect();
      // matricula_id, data_rascunho, newdate, area, proprietarios, cad_imobiliario, onus_vigente, data_conf, datanova, nome, atos_cadastrados, atos_existentes, duvidas 
      $sql = 'SELECT * FROM rascunho_cm ORDER BY matricula_id';
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
              // Swal.fire({
              // type: 'success',
              // title: 'Enviado',
              // text: 'AJAX result: ' + response + '; status: ' + textStatus,
              // })
              $('body')
              .toast({
                class: 'success',
                message: '<?php echo $_SESSION['user_name']; ?> editou a Matricula: ' + cell.getRow().getIndex() +' Valor  antigo '+ cell.getOldValue() + ' Valor atual ' + cell.getValue()
              })
            ;
          },
          error: function(XMLHttpRequest, textStatus, error){
              //alert("AJAX error: " + textStatus + "; " + error);
              $('body')
              .toast({
                class: 'error',
                message: `An error occured !`
              })
            ;
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