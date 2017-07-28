<?php
header('Access-Control-Allow-Origin: *');
//header('Content-Type: application/json');

include '../php/Conexao.php';

$matricula = $_POST['matricula'];
$senha = md5($_POST['senha']);
$token =  $_POST['id']; 
//unlink('bloco1.txt');

$sql = "update aluno set token='$token',senha='$senha',alunoativo=1 where matricula='$matricula'";
$stmt = $conexao->prepare($sql);
$stmt->execute(); 


$linhas = $stmt->rowCount();


$fp = fopen("bloco1.txt", "a");

// Escreve "exemplo de escrita" no bloco1.txt
$escreve = fwrite($fp, $_POST['senha'].$sql);

// Fecha o arquivo
fclose($fp); 

echo $linhas;
?>