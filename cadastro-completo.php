<?php

require 'conexao.php';
require 'src/Pessoa.php';
require 'src/Telefone.php';
require 'src/Cadastro.php';
require 'src/Estado.php';
require 'src/Endereco.php';

$cadastro = new Cadastro($mysql);

$estado = new Estado($mysql);

$pessoaCadastrada = $cadastro->exibirCadastroCompleto($_GET['id']);

$telefone = new Cadastro($mysql);
$telefoneCadastrado = $telefone->exibirTelefonePorPessoa_id($_GET['id']);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cadastro completo</title>
</head>
<body>
    <header><img src="imagens/webdec-home.png" alt="logo"></header>
    <h1>Cadastro</h1>
    <nav>
        <a href="index.php" class="link-opcao">Home</a>
        <a href="cadastrar.php"><img height="25px" width="30px" src="imagens/adicionar.png" alt="icone-adicionar"></a>
    </nav>
    <div class="caixa">
        <h2>Dados Pessoais</h2>
        <p>Nome: <?php echo $pessoaCadastrada['nome']; ?></p> <p> CPF: <?php echo $pessoaCadastrada['cpf']; ?></p> <p>RG: <?php echo $pessoaCadastrada['rg']; ?></p> <p> Data de Nascimento: <?php echo $pessoaCadastrada['data_nascimento']; ?></p>
    </div>
    <div class="caixa">
        <h2>Endereço</h2>
        <p>Estado: <?php echo $pessoaCadastrada['uf']; ?></p>  <p>CEP: <?php echo $pessoaCadastrada['cep']; ?></p>  <p>Endereço: <?php echo $pessoaCadastrada['endereco']; ?></p> <p>Número: <?php echo $pessoaCadastrada['numero']; ?></p>
    </div>
    <div class="caixa">
        <h2>Contatos</h2>
        <p>Telefone: <?php if (isset($telefoneCadastrado['telefone'])) : echo $telefoneCadastrado['telefone']; endif ?></p>
        <p>Data da última atualização: <?php echo $pessoaCadastrada['data_atualizacao']; ?></p> <p> Data de Cadastro: <?php echo $pessoaCadastrada['data_cadastro']; ?></p>
    </div>