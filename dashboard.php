<?php
session_start();
//require_once('conexao.php');

require 'init.php';
require 'check.php';
?>
    

<?php include'header_admin.html' ?>
<table class="ui selectable inverted table">
  <thead>
    <tr>
      <th>Name</th>
      <th>Status</th>
      <th class="right aligned">Notes</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>John</td>
      <td>Approved</td>
      <td class="right aligned">None</td>
    </tr>
    <tr>
      <td>Jamie</td>
      <td>Approved</td>
      <td class="right aligned">Requires call</td>
    </tr>
    <tr>
      <td>Jill</td>
      <td>Denied</td>
      <td class="right aligned">None</td>
    </tr>
  </tbody>
</table>

</body>
<script>


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


 </script>
</html>