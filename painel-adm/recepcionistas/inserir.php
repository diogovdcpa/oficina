<?php

require_once('../../conexao.php');

$nome = $_POST['nome_mec'];
$cpf = $_POST['cpf_mec'];
$telefone = $_POST['telefone_mec'];
$email = $_POST['email_mec'];
$endereco = $_POST['endereco_mec'];

$antigo = $_POST['antigo'];
$id = $_POST['txtid2'];

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



// VERIFICA SE JA EXISTE REGISTRO NO BANCO DE DADOS
if ($antigo != $cpf) {
    $query = $pdo->query("SELECT * FROM recepcionistas where cpf = '$cpf' ");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total_reg = @count($res);
    if ($total_reg > 0) {
        echo "CPF ja existe";
        exit();
    }
}

// INSERINDO E EDITANDO DADOS.
if ($id == "") { // INSERINDO DADOS NO BANCO
    // INSERINDO NA TABELA recepcionistas
    $res = $pdo->prepare("INSERT INTO recepcionistas SET nome = :nome, cpf = :cpf, telefone = :telefone, email = :email, endereco = :endereco");

    // INSERINDO NA TABELA USUARIOS
    $res2 = $pdo->prepare("INSERT INTO usuarios SET nome = :nome, cpf = :cpf, email = :email, senha = :senha, nivel = :nivel");

    $res2->bindValue(":senha", '123');
    $res2->bindValue(":nivel", 'recep');
} else { // EDITANDO REGISTRO
    // EDITANDO DADOS recepcionistas
    $res = $pdo->prepare("UPDATE recepcionistas SET nome = :nome, cpf = :cpf, telefone = :telefone, email = :email, endereco = :endereco WHERE id = '$id' ");

    // EDITANDO DADOS USUARIOS
    $res2 = $pdo->prepare("UPDATE usuarios SET nome = :nome, cpf = :cpf, email = :email WHERE cpf = '$antigo' ");
}

$res->bindValue(":nome", $nome);
$res->bindValue(":cpf", $cpf);
$res->bindValue(":telefone", $telefone);
$res->bindValue(":email", $email);
$res->bindValue(":endereco", $endereco);

$res2->bindValue(":nome", $nome);
$res2->bindValue(":cpf", $cpf);
$res2->bindValue(":email", $email);


$res->execute();
$res2->execute();

echo "Salvo com Sucesso!!";
