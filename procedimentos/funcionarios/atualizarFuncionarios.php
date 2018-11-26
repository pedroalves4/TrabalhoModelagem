<?php 


require_once "../../classes/conexao.php";
require_once "../../classes/funcionarios.php";



$obj = new funcionario();



$dados=array(
	$_POST['idfuncionarioU'],
	$_POST['nomeU'],
	$_POST['sobrenomeU'],
	$_POST['enderecoU'],
	$_POST['emailU'],
	$_POST['telefoneU'],
	$_POST['cpfU']
	

);

echo $obj->atualizar($dados);

 ?>