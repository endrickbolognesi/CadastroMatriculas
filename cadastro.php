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
    //   persistentLayout: true,
    // persistentSort: true,
    // persistenceID:"examplePerststance",

      index: "matricula_id",
      // selectableRollingSelection:false,
      ajaxURL:"teste2.php",
      
      //height:"800px",

      layout:"fitColumns",
      responsiveLayout:true,
      pagination:"local",
      paginationSize:50,
      paginationSizeSelector:[10, 50, 100, 200],
      
      //persistenceMode: true,
      columns:[
          {title:"Matricula", field:"matricula_id", width:100, frozen:true},
          {title:"Nome", field:"nome", width:100,editor:true},
          {title:"Data Certa F", field:"newdate", formatter:"datetime",editor:true, formatterParams:{
              inputFormat:"YYYY-MM-DD",
              outputFormat:"DD/MM/YYYY",
              invalidPlaceholder:"(Data inválida)",
          }},
          {title:"Atos Cadastrados", field:"atos_cadastrados",editor:true},
          {title:"Atos Existentes", field:"atos_existentes",editor:true},
          {title:"Dúvidas", field:"duvidas",editor:true},
      ],
      
      cellEdited:function(cell){
          // This callback is called any time a cell is edited.
          $.ajax({
          url: "salva_celula.php",
          data: {valor: cell.getValue(), campo: cell.getField(), index: cell.getRow().getIndex(), old: cell.getOldValue()},
          // getField <<<<<<<<<<<<<<<<<
          
          type: "post",
          beforeSend : function (valor, campo, index, old) {
           console.log('<?php echo $_SESSION['user_name']; ?>' + ' editou ' + cell.getValue() + ' ' + cell.getField() + ' ' + cell.getRow().getIndex() + ' Valor antigo: ' + cell.getOldValue());
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
                
                message: 'AJAX result: ' + response + '; status: ' + textStatus + '<?php echo $_SESSION['user_name']; ?> editou a Matricula: ' + cell.getRow().getIndex() +' Valor antigo '+ cell.getOldValue() + ' Valor atual ' + cell.getValue()
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

  
  
      </script>
</body>
</html>