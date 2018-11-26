<?php 
session_start();
if(isset($_SESSION['usuario'])){

	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>Funcionarios</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>
		<div class="container">
			<h1>Funcionarios</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmFuncionario">
						<label>Nome</label>
						<input type="text" class="form-control input-sm" id="nome" name="nome">
						<label>Sobrenome</label>
						<input type="text" class="form-control input-sm" id="sobrenome" name="sobrenome">
						<label>Endereço</label>
						<input type="text" class="form-control input-sm" id="endereco" name="endereco">
						<label>Email</label>
						<input type="text" class="form-control input-sm" id="email" name="email">
						<label>Telefone</label>
						<input type="text" class="form-control input-sm" id="telefone" name="telefone">
						<label>CPF</label>
						<input type="text" class="form-control input-sm" id="cpf" name="cpf">
						<p></p>
						<span class="btn btn-primary" id="btnAdicionarFuncionario">Salvar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tabelaFuncionarioLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="abremodalFuncionarioUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Atualizar Funcionario</h4>
					</div>
					<div class="modal-body">
						<form id="frmFuncionarioU">
							<input type="text" hidden="" id="idfuncionarioU" name="idfuncionarioU">
							<label>Nome</label>
							<input type="text" class="form-control input-sm" id="nomeU" name="nomeU">
							<label>Sobrenome</label>
							<input type="text" class="form-control input-sm" id="sobrenomeU" name="sobrenomeU">
							<label>Endereço</label>
							<input type="text" class="form-control input-sm" id="enderecoU" name="enderecoU">
							<label>Email</label>
							<input type="text" class="form-control input-sm" id="emailU" name="emailU">
							<label>Telefone</label>
							<input type="text" class="form-control input-sm" id="telefoneU" name="telefoneU">
							<label>CPF</label>
							<input type="text" class="form-control input-sm" id="cpfU" name="cpfU">
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnAdicionarFuncionarioU" type="button" class="btn btn-primary" data-dismiss="modal">Atualizar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		function adicionarDado(idfuncionario){

			$.ajax({
				type:"POST",
				data:"idfuncionario=" + idfuncionario,
				url:"../procedimentos/funcionarios/obterDadosFuncionarios.php",
				success:function(r){



					dado=jQuery.parseJSON(r);


					$('#idfuncionarioU').val(dado['id_funcionario']);
					$('#nomeU').val(dado['nome']);
					$('#sobrenomeU').val(dado['sobrenome']);
					$('#enderecoU').val(dado['endereco']);
					$('#emailU').val(dado['email']);
					$('#telefoneU').val(dado['telefone']);
					$('#cpfU').val(dado['cpf']);



				}
			});
		}

		function eliminar(idfuncionario){
			alertify.confirm('Deseja Excluir este funcionario?', function(){ 
				$.ajax({
					type:"POST",
					data:"idfuncionario=" + idfuncionario,
					url:"../procedimentos/funcionarios/eliminarFuncionarios.php",
					success:function(r){



						if(r==1){
							$('#tabelaFuncionarioLoad').load("funcionarios/tabelaFuncionarios.php");
							alertify.success("Excluido com sucesso!!");
						}else{
							alertify.error("Não foi possível excluir");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelado !')
			});
		}
	</script>

	<script type="text/javascript">
		$(document).ready(function(){

			$('#tabelaFuncionarioLoad').load("funcionarios/tabelaFuncionarios.php");

			$('#btnAdicionarFuncionario').click(function(){

				vazios=validarFormVazio('frmFuncionario');

				if(vazios > 0){
					alertify.alert("Preencha os Campos!!");
					return false;
				}

				dados=$('#frmFuncionario').serialize();

				$.ajax({
					type:"POST",
					data:dados,
					url:"../procedimentos/funcionarios/adicionarFuncionarios.php",
					success:function(r){

						if(r==1){
							$('#frmFuncionario')[0].reset();
							$('#tabelaFuncionarioLoad').load("funcionarios/tabelaFuncionarios.php");
							alertify.success("Funcionario Adicionado");
						}else{
							alertify.error("Não foi possível adicionar");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnAdicionarFuncionarioU').click(function(){
				dados=$('#frmFuncionarioU').serialize();

				$.ajax({
					type:"POST",
					data:dados,
					url:"../procedimentos/funcionarios/atualizarFuncionarios.php",
					success:function(r){

						
						if(r==1){
							$('#frmFuncionario')[0].reset();
							$('#tabelaFuncionarioLoad').load("funcionarios/tabelaFuncionarios.php");
							alertify.success("Funcionario atualizado com sucesso!");
						}else{
							alertify.error("Não foi possível atualizar Funcionario");
						}
					}
				});
			})
		})
	</script>


	<?php 
}else{
	header("location:../index.php");
}
?>