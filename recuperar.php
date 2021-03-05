<?php
require_once('conexao.php');

echo $email = $_POST['email'];

if($email == ""){
    echo "Email precisa ser preenchido !";
    exit();
}

$res = $pdo->query("SELECT * FROM usuarios WHERE email = '$email' ");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
if($dados > 0){
    $senha = $dados[0]['senha'];
    echo $senha;
}else{
    echo 'Email nao cadastrado!';
}

