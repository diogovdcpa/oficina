<?php

require_once('conexao.php');
@session_start();

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = $pdo->prepare("SELECT * FROM usuarios where email = :email and senha = :senha ");
$sql->bindValue(":email",$email);
$sql->bindValue(":senha",$senha);
$sql->execute();

$res = $sql->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if($total_reg > 0){
    $_SESSION['id_usu'] = $res[0]['id'];
    $_SESSION['nome_usu'] = $res[0]['nome'];
    $_SESSION['cpf_usu'] = $res[0]['cpf'];
    $_SESSION['nivel_usu'] = $res[0]['nivel'];

    $nivel = $res[0]['nivel'];

    if($nivel == 'admin'){
        echo "<script language='javascript'> window.location='painel-adm' </script>";
    }
    if($nivel == 'mecanico'){
        echo "<script language='javascript'> window.location='painel-mecanico' </script>";
    }
    if($nivel == 'recep'){
        echo "<script language='javascript'> window.location='painel-recepcao' </script>";
    }
}else{
    echo "<script language='javascript'> window.alert('Usuario ou Senha Incorreto')</script>";
    echo "<script language='javascript'> window.location='index.php' </script>";
}
