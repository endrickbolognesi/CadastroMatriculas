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



 $('.ui.accordion').accordion({
   selector: {

   }
 });
        
      
  
  $("#download-xlsx").click(function(){
      table.download("xlsx", "data.xlsx", {sheetName:"teste"});
  });

// $('.mav').dropdown({
//   on: 'hover'
// });
// $('.mav').on('click', function() {   
//   $(this)    .addClass('active')
//     .siblings()
//     .removeClass('active'); 
// })
      // $('.menu')
      //   .on('click', '.item', function() {
      //     if(!$(this).hasClass('dropdown')) {
      //       $(this)
      //         .addClass('active')
      //         .siblings('.item')
      //         .removeClass('active');
      //     }
      //   });
      $(document).ready(function(){
    $('.mav').on('click', function() {
        $('.mav').removeClass('active');
        $(this).addClass('active');
    });             
});
