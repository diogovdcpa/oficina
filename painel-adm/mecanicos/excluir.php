<?php
require_once('../../conexao.php');

$id = $_POST['id'];

$query = $pdo->query("SELECT * FROM mecanicos WHERE id = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$cpf_usu = $res[0]['cpf'];

$query_id = $pdo->query("SELECT * FROM usuarios WHERE cpf = '$cpf_usu' ");
$res_usu = $query_id->fetchAll(PDO::FETCH_ASSOC);
$id_usu = $res_usu[0]['id'];

$pdo->query("DELETE FROM mecanicos WHERE id = '$id' ");
$pdo->query("DELETE FROM usuarios WHERE id = '$id_usu' ");

echo 'Excluído com Sucesso!!';