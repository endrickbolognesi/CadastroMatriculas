<?php
session_start();
//require_once('conexao.php');

require 'init.php';
require 'check.php';
?>
 <style type="text/css">
 	#tabela{
 		margin-top: 10px;
 		
 	}
 </style>   

<?php include'header_admin.html' ?>
<div class="ui  doubling stackable grid container">

<div class="column">
	
<table id="tabela" class="ui very compact selectable inverted table ">
<!-- 	<thead class="full-width">
    <tr>
      <th></th>
      <th colspan="4">
        <div class="ui right floated small green labeled icon button">
          <i class="user  icon"></i> Novo
        </div>
      </th>
    </tr>
  </thead> -->
  <thead>
    <tr>
      <th>Nome</th>
      <th>Login</th>
      <th>Tipo</th>
      <th class="two wide ">
      	<div id="novo" class="ui right floated small green labeled icon button">
          <i class="user icon"></i> Novo
        </div>	
      </th>
      <!-- <th>Ações</th> -->
    </tr>
  </thead>
 
      
      
      
    
  <tbody>

  	 <?php

      $conn = db_connect();
      $sql = 'SELECT *
          FROM users
          ORDER BY id';
      $data = $conn->query($sql);
      $data->setFetchMode(PDO::FETCH_ASSOC);
  	while ($r = $data->fetch()): 
      ?>
		
    <tr>
      <td><?php echo $r['name'] ?></td>
      <td><?php echo $r['login'] ?></td>
      <td >
      	<?php if ($r['fknivel'] == 1){ 
      		echo "Conferência"; 
      	}elseif($r['fknivel'] == 2){
      		echo "Cadastro";
      	}else{
      		echo "Admin"; 
      	} ?>
      	</td>
      	<td class="center aligned">
			<div >
				<a href="edita_user.php" class="ui yellow icon button">
				  <i class="edit icon"></i>
				</a>
			
				<a id="<?php echo $r['id'] ?>" class="ui delete red icon button">
				  <i class="trash icon"></i>
				</a>
			</div>	
      </td>
    
    </tr>

    <?php endwhile; ?>
  </tbody>
</table>
</div>


</div>
<div class="ui inverted modal">
	<i class="close icon"></i>
	<div class="header">
		Cadastrar Novo Usuário
	</div>
	<div class="content">
		<form id="create_user" class="ui inverted form">

			<div class="field">
				<label>Nome do usuário</label>
				<input id="nome" type="text" name="first-name" placeholder="Nome">
			</div>
			<div class="fields">
				<div class="twelve  wide field">
					<label>Login</label>
					<input id="login" type="text" name="login" placeholder="Login">
				</div>
				<div class="twelve  wide field">
					<label>Senha</label>
					<input id="senha" type="password" name="password" placeholder="Senha">
				</div>
				
			</div>
			<div class="field">
					<label>Tipo</label>
					<div class="ui selection dropdown">
						<input id="tipo" type="hidden" name="tipo">
						<i class="dropdown icon"></i>
						<div class="default text">seleciona o nivel de acesso</div>
						<div class="menu">
							<?php

							      $conn = db_connect();
							      $sql = 'SELECT *
							          FROM niveis
							          ORDER BY nivel_id';
							      $data = $conn->query($sql);
							      $data->setFetchMode(PDO::FETCH_ASSOC);
							  	while ($r = $data->fetch()): 
							      ?>
							<div  class="item" data-value="<?php echo $r['nivel'] ?>"><?php echo $r['descricao'] ?></div>
							<?php endwhile; ?>
						</div>
					</div>
				</div>
			<!-- <button class="ui button " type="submit">Cadastrar</button>
			<button class="ui button right floated" type="submit">Cadastrar</button> -->
		</form>
	</div>
	<div class="actions">
		<div class="ui button left floated red">Cancelar</div>
		<div id="send_create_user" class="ui button green">Cadastrar</div>
	</div>
</div>
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

$('#novo').on("click", function(){

	$('.ui.modal').modal('show');
})
  	//Criar usuário
    $(document).ready(function() {
      $('#send_create_user').click(function() { //Ao submeter formulário
          var nome = $('#nome').val(); //Pega valor do campo email
          var senha = $('#senha').val();
          var login = $('#login').val();
          var tipo = $('#tipo').val(); //Pega valor do campo password
          $.ajax({ //Função ajax
              url: "cria_user.php", //Arquivo php
              type: "post", //Método de envio
              data: {nome: nome, senha: senha, login: login, tipo: tipo}, //Dados
 
	          success: function(nome){
	              //alert("AJAX result: " + response + "; status: " + textStatus);
	              $('body')
              .toast({
                class: 'success',
                message: "Usuário cadastrado com sucesso"
              })
            ;
	              
	          },


          })
          return false; //Evita que a página seja atualizada
      });
      

    //Deleta usuario

      $('.delete').click(function() { 
         id = $(this).attr("id");
          $.ajax({ 
              url: "delete_user.php", 
              type: "post", 
              data: {id: id}, 
 				
 				beforeSend : function (id) {
 					Swal.fire({
					  title: 'Você tem certeza que deseja excluir?',
					  type: 'warning',
					  showCancelButton: true,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  confirmButtonText: 'Sim, desejo deletar!',
					  cancelButtonText: 'Cencelar'
						}).then((result) => {
					  if (result.value) {
					    Swal.fire(
					      'Deletado!',
					      'O usuário foi removido.',
					      'success'
					    )
					  }
					})

		          },



          })
          return false; //Evita que a página seja atualizada
      })
 })	


 </script>
</html>