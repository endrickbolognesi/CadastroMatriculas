<?php
    require_once('conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="semantic/semantic.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link href="node_modules/tabulator-tables/dist/css/tabulator.min.css" rel="stylesheet">
    <link href="node_modules/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="semantic/semantic.js"></script>
    <script type="text/javascript" src="http://oss.sheetjs.com/js-xlsx/xlsx.full.min.js"></script>
    <script type="text/javascript" src="node_modules/tabulator-tables/dist/js/tabulator.js"></script>
    <script type="text/javascript" src="node_modules/moment/min/moment.min.js"></script>
    <script type="text/javascript" src="node_modules/sweetalert2/dist/sweetalert2.min.js"></script>

    <title>Conferência</title>
</head>
<style>

</style>
<body>
  <div class="pusher">
    <div class="ui top inverted menu asd marginlefting borderless"
      style="border-radius: 0!important; border: 0; margin-left: 260px; -webkit-transition-duration: 0.1s;">
      <a class="item openbtn">
        <i class="icon content"></i>
      </a>
      <a class="mav red item" href="cadastro.php">Cadastro</a>
      <a class="mav blue item" href="conferencia.php" >Conferência</a>
      <a class="mav orange item" href="horas.php">Planilha de horas</a>

      <div class="right menu">
        <div class="item">
          <div class="ui toggle checkbox">
            <input type="checkbox" tabindex="0" class="hidden darkmode">
          </div>
        </div>

        <div class="ui dropdown item">
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
<div class="ui inverted sidebar very thin icon vertical left menu overlay visible  "
  style="-webkit-transition-duration: 0.1s; overflow: visible !important; ">
  <!-- <div class="item logo">
    <img src="https://image.flaticon.com/icons/svg/866/866218.svg" />
    <img src="https://image.flaticon.com/icons/svg/866/866218.svg" style="display: none" />
  </div> -->
  <div class="ui accordion displaynone">
    <div class="title item">Dashboard <i class="dropdown icon"></i>
    </div>
    <div class="content">
      <a class="item" href="dashboard.html">Dashboard </a>
    </div>

    <div class="title item">
      <i class="dropdown icon"></i> Apps
    </div>
    <div class="content">
      <a class="item" href="inbox.html
      </a>
      <a class="item" href="mail.html">Mailbox</a>
      <a class="item" href="chat.html">Chat</a>
      <a class="item" href="contacts.html">Contacts</a>
      <a class="item" href="photoeditor.html">Photo
      </a>
      <a class="item" href="calendar.html">Calendar</a>
      <a class="item" href="filter.html">Filter</a>
      <a class="item" href="todo.html">Todo</a>
    </div>
    <div class="title item">
      <i class="dropdown icon"></i> Layouts
    </div>
    <div class="content">
      <a class="item" href="sidebar.html">Sidebar</a>
      <a class="item" href="menu.html">Nav</a>
      <a class="item" href="animatedicon.html">Animated     </a>
      <a class="item" href="box.html">Box</a>
      <a class="item" href="cards.html">Cards</a>
      <a class="item" href="color.html">Colors</a>
      <a class="item" href="comment.html">Comment</a>
      <a class="item" href="embed.html">Embed</a>
      <a class="item" href="faq.html">Faq</a>
      <a class="item" href="feed.html">Feed</a>
      <a class="item" href="gallery.html">Gallery</a>
      <a class="item" href="grid.html">Grid</a>
      <a class="item" href="header.html">Header</a>
      <a class="item" href="timeline.html">Timeline</a>
      <a class="item" href="message.html">Message</a>
      <a class="item" href="price.html">Price</a>
    </div>

    <a class="item">
      <b>Components</b>
    </a>


  </div>
  <div class="ui dropdown item displayblock displaynone ">
    <z class="displaynone">Dashboard</z>
    <i class="icon demo-icon heart icon-heart"></i>

    <div class=" menu">
      <div class="header">
        Dashboard
      </div>
      <div class="ui divider"></div>
      <a class="item" href="dashboard.html">Dashboard</a>
    </div>
  </div>
  <div class="ui dropdown item displayblock displaynone ">
    <z class="displaynone">Layout</z>
    <i class="icon demo-icon world icon-globe"></i>

    <div class="menu">
      <div class="header">
        Layout
      </div>
      <div class="ui divider"></div>
      <a class="item" href="inbox.html">Inbox</a>
      <a class="item" href="mail.html">Mailbox</a>
      <a class="item" href="chat.html">Chat</a>
      <a class="item" href="contacts.html">Contacts</a>
      <a class="item" href="photoeditor.html">Photo
      </a>
      <a class="item" href="calendar.html">Calendar</a>
      <a class="item" href="filter.html">Filter</a>
      <a class="item" href="todo.html">Todo</a>
    </div>
  </div>
  <div class="ui dropdown item displayblock displaynone ">
    <z class="displaynone">Pages</z>
    <i class="icon demo-icon  icon-params alarm"></i>

    <div class=" menu">
      <div class="header">
        Layouts
      </div>
      <div class="ui divider"></div>
      <a class="item" href="sidebar.html">Sidebar</a>
      <a class="item" href="menu.html">Nav</a>
      <a class="item" href="animatedicon.html">Animated     </a>
      <a class="item" href="box.html">Box</a>
      <a class="item" href="cards.html">Cards</a>
      <a class="item" href="color.html">Colors</a>
      <a class="item" href="comment.html">Comment</a>
      <a class="item" href="embed.html">Embed</a>
      <a class="item" href="faq.html">Faq</a>
      <a class="item" href="feed.html">Feed</a>
      <a class="item" href="gallery.html">Gallery</a>
      <a class="item" href="grid.html">Grid</a>
      <a class="item" href="header.html">Header</a>
      <a class="item" href="timeline.html">Timeline</a>
      <a class="item" href="message.html">Message</a>
      <a class="item" href="price.html">Price</a>
    </div>
  </div>
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