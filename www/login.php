<?php
header('Access-Control-Allow-Origin: *');
//header('Content-Type: application/json');

include '../php/Conexao.php';

$matricula = $_POST['login'];
$senha = md5($_POST['senha']);



$sql = "select * from aluno where senha='$senha' and matricula='$matricula'";
$stmt = $conexao->prepare($sql);
$stmt->execute(); 


 if($stmt->rowCount() >0){
$resultado = $stmt->fetchAll();

	foreach($resultado as $linha){
		$retorno = $linha["matricula"];
	}

    echo $retorno;
 }else{
 	echo "invalido";
 } 


?>