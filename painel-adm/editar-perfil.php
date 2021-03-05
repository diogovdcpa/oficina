<?php

require_once('../conexao.php');

$nome = $_POST['nome_usu'];
$cpf = $_POST['cpf_usu'];
$email = $_POST['email_usu'];
$senha = $_POST['senha_usu'];

$antigo = $_POST['antigo_usu'];
$id = $_POST['id_usu'];

if ($nome == "") {
    echo "O nome é obrigatorio";
    exit();
}

if ($cpf == "") {
    echo "O CPF é obrigatorio";
    exit();
}

if ($email == "") {
    echo "O email é obrigatorio";
    exit();
}

if ($antigo != $cpf) {
    $query = $pdo->query("SELECT * FROM usuarios where cpf = '$cpf' ");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if ($total_reg > 0) {
        echo "CPF ja existe";
        exit();
    }
}

$res = $pdo->prepare("UPDATE usuarios SET nome = :nome, cpf = :cpf, email = :email, senha = :senha WHERE id = '$id' ");

$res->bindValue(":nome", $nome);
$res->bindValue(":cpf", $cpf);
$res->bindValue(":email", $email);
$res->bindValue(":senha", $senha);

$res->execute();

echo 'Salvo com Sucesso!!';