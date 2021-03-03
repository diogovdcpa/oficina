<?php

require_once('../../conexao.php');

$nome = $_POST['nome_mec'];
$cpf = $_POST['cpf_mec'];
$telefone = $_POST['telefone_mec'];
$email = $_POST['email_mec'];
$endereco = $_POST['endereco_mec'];

$antigo = $_POST['antigo'];
$id = $_POST['txtid2'];

if($nome == ""){
    echo "O nome é obrigatorio";
    exit();
}

if($cpf == ""){
    echo "O CPF é obrigatorio";
    exit();
}

if($email == ""){
    echo "O email é obrigatorio";
    exit();
}



// VERIFICA SE JA EXISTE REGISTRO NO BANCO DE DADOS
if ($antigo != $cpf) {
    $query = $pdo->query("SELECT * FROM mecanicos where cpf = '$cpf' ");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
}

if ($total_reg > 0) {
    echo "CPF ja existe";
    exit();
}

if ($id == "") {// INSERINDO DADOS NO BANCO
    $res = $pdo->prepare("INSERT INTO mecanicos SET nome = :nome, cpf = :cpf, telefone = :telefone, email = :email, endereco = :endereco");
} else { // EDITANDO REGISTRO
    $res = $pdo->prepare("UPDATE mecanicos SET nome = :nome, cpf = :cpf, telefone = :telefone, email = :email, endereco = :endereco WHERE id = :id");
    $res->bindValue(":id", $id);
}

$res->bindValue(":nome", $nome);
$res->bindValue(":cpf", $cpf);
$res->bindValue(":telefone", $telefone);
$res->bindValue(":email", $email);
$res->bindValue(":endereco", $endereco);
$res->execute();

echo "Salvo com Sucesso!!";
