<?php
session_start();
//require_once('conexao.php');

require 'init.php';
require 'check.php';
?>
<?php include'header.html' ?>
<div id="example-table" class="marginlefting asd" style="border-radius: 0!important; border: 0; margin-left: 260px; -webkit-transition-duration: 0.1s;"></div>
  

  <script type="text/javascript" src="js/table.js"></script>
<script>

     
     var teste = [
      <?php
       $conn = db_connect();
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
          dataCerta:"<?php echo $r['datanova']; ?>",
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
           Swal.fire({
              type: 'success',
              title: 'Enviado',
              text: 'AJAX result: ' + response + '; status: ' + textStatus,
              })
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
  

  
  
      </script>



</body>
</html>