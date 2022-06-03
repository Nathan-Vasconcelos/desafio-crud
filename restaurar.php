<?php

require 'conexao.php';
require 'src/Cadastro.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //excluir cadastro de forma não permanente
    $cadastro = new Cadastro($mysql);
    $cadastro->restaurar($_POST[id]);

    header('location: index.php');
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>restaurar cadastro</title>
</head>
<body>
    <header><img src="imagens/webdec-home.png" alt="logo"></header>
    <nav>
        <a href="index.php" class="link-opcao">Home</a>
        <a href="cadastrar.php"><img height="25px" width="30px" src="imagens/adicionar.png" alt="icone-adicionar"></a>
    </nav>
    <h1>deseja restaurar o cadastro?</h1>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
        <input type="submit" value="Restaurar" class="butao-enviar">
        <a href="index.php" class="link-opcao">Voltar</a>
    </form>
</body>