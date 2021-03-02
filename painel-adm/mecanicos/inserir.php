<?php

require_once('../../conexao.php');

$nome = $_POST['nome_mec'];
$cpf = $_POST['cpf_mec'];
$telefone = $_POST['telefone_mec'];
$email = $_POST['email_mec'];
$endereco = $_POST['endereco_mec'];

$query = $pdo->query("SELECT * FROM mecanicos where cpf = '$cpf' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if($total_reg > 0){
    echo "CPF ja existe";
    exit();
}

$query = $pdo->prepare("INSERT INTO mecanicos SET nome = :nome, cpf = :cpf, nome = :nome, telefone = :telefone, email = :email, endereco = :endereco");