<?php

require 'conexao.php';
require 'src/Cadastro.php';
require 'src/Telefone.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //excluir cadastro de forma permanente

    $cadastro = new Cadastro($mysql);

    $telefone = new Cadastro($mysql);
    $telefoneCadastrado = $telefone->exibirTelefonePorPessoa_id($_GET['id']);

    if (isset($telefoneCadastrado['telefone'])) {
        //excluir telefone
        $cadastro->excluirTelefone($telefoneCadastrado['id']);
        
    }

    $cadastro->excluirCadastroDoBanco($_POST[id]);

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
    <title>Excluir cadastro</title>
</head>
<body>
    <header><img src="imagens/webdec-home.png" alt="logo"></header>
    <nav>
        <a href="index.php" class="link-opcao">Home</a>
        <a href="cadastrar.php"><img height="25px" width="30px" src="imagens/adicionar.png" alt="icone-adicionar"></a>
    </nav>
    <h1>Tem certeza que deseja excluir o cadastro do banco?</h1>
    <h1>você não vai mais poder restaurar esse cadastro</h1>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
        <input type="submit" value="excluir" class="butao-enviar">
        <a href="index.php" class="link-opcao">Voltar</a>
    </form>
</body>