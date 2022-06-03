<?php

require 'conexao.php';
require 'src/Pessoa.php';
require 'src/Telefone.php';
require 'src/Cadastro.php';
require 'src/Estado.php';
require 'src/Endereco.php';

$cadastro = new Cadastro($mysql);

$estado = new Estado($mysql);
$estados = $estado->exibirTodos();

$pessoaCadastrada = $cadastro->exibirCadastro($_GET['id']);


$telefone = new Cadastro($mysql);
$telefoneCadastrado = $telefone->exibirTelefonePorPessoa_id($_GET['id']);
$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (($_POST['telefone'] !== '')) {
        //adicionar telefone
        $telefone = new Telefone($mysql, $id, $_POST['telefone']);
        $telefone->salvaTelefone();
    }

    $endereco = new Endereco($mysql, $_POST['estado'], $pessoaCadastrada['cep'], $pessoaCadastrada['endereco'], $pessoaCadastrada['numero']);
    $endereco->editar($pessoaCadastrada['endereco_id']);
    
    $cadastro = new Pessoa($mysql, $_POST['nome'], $_POST['cpf'], $_POST['rg'], $_POST['data-nascimento']);
    $cadastro->recebeId($id);
    $cadastro->editar();

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
    <title>Editar</title>
</head>
<body>
    <header><img src="imagens/webdec-home.png" alt="logo"></header>
    <h1>Editar cadastro</h1>
    <div class="conteiner-cadastro">
        <form action="" method="post">
            <legend class="legend-cadastro">Dados pessoais</legend>

            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" value="<?php echo $pessoaCadastrada['nome']; ?>" required required class="conteiner-cadastro-input">

            <label for="cpf">CPF</label>
            <input type="text" id="cpf" name="cpf" value="<?php echo $pessoaCadastrada['cpf']; ?>" required placeholder="123.456.789.10" required class="conteiner-cadastro-input">

            <label for="rg">RG</label>
            <input type="text" id="rg" name="rg" value="<?php echo $pessoaCadastrada['rg']; ?>" required placeholder="12.345.789-1" required class="conteiner-cadastro-input">

            <label for="data-nascimento">Data de nascimento</label>
            <input type="date" id="data-nascimento" name="data-nascimento" value="<?php echo $pessoaCadastrada['data_nascimento']; ?>" required class="conteiner-cadastro-input">
    </div>
    <div class="conteiner-cadastro">
        <legend class="legend-cadastro">Endereço e contatos</legend>
        <label for="telefone">telefone</label>
        <input type="tel" name="telefone" id="telefone" value="<?php if (isset($telefoneCadastrado['telefone'])) : echo $telefoneCadastrado['telefone']; endif ?>" placeholder="(21)98989-8989" required class="conteiner-cadastro-input">

        <label for="estado">ESTADO</label>
        <select name="estado" id="estado">
            
            <?php foreach ($estados as $uf) : ?>
                <?php if ($uf['uf'] === $pessoaCadastrada['uf']) : ?>
                    <option selected="selected" value="<?php echo $uf['id']; ?>"><?php echo $uf['uf']; ?></option>
                <?php endif ?>
                <option value="<?php echo $uf['id']; ?>"><?php echo $uf['uf']; ?></option>
            <?php endforeach ?>
    
        </select>

        <label for="cep">CEP</label>
        <input type="text" id="cep" name="cep" required value="<?php echo $pessoaCadastrada['cep']; ?>" required class="conteiner-cadastro-input">

        <label for="endereco">Endereço</label>
        <input type="text" id="endereco" name="endereco" required value="<?php echo $pessoaCadastrada['endereco']; ?>" required class="conteiner-cadastro-input">

        <label for="numero">Número</label>
        <input type="text" id="numero" name="numero" required value="<?php echo $pessoaCadastrada['numero']; ?>" required class="conteiner-cadastro-input">
    </div>
        <input type="submit" class="butao-enviar-cadastro">
</body>
</html>