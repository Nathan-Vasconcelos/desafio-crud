<?php

require 'conexao.php';
require 'src/Pessoa.php';
require 'src/Estado.php';
require 'src/Endereco.php';
require 'src/Telefone.php';

$estado = new Estado($mysql);
$estados = $estado->exibirTodos();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $cadastro = new Pessoa($mysql, $_POST['nome'], $_POST['cpf'], $_POST['rg'], $_POST['data-nascimento']);
    $cpfValido = $cadastro->validaCpf();

    if ($cpfValido){
        //cadastrar o endereço
        $endereco = new Endereco($mysql, $_POST['estado'],$_POST['cep'], $_POST['endereco'], $_POST['numero']);
        $cepValido = $endereco->validaCep();

        if ($cepValido) {
            //cadastra
            $endereco->cadastrar();
        }
        $enderecoId = $endereco->recuperaId();

        //cadastrar pessoa
        $cadastro->recebeEnderecoId($enderecoId);
        $idPessoaCadastrada = $cadastro->Cadastrar();

        if (($_POST['telefone'] !== '')) {
            //adicionar telefone
            $telefone = new Telefone($mysql, $idPessoaCadastrada, $_POST['telefone']);
            $telefoneValido = $telefone->validaTelefone();
            if ($telefoneValido) {
                //telefone será cadastrado
                $telefone->cadastraTelefone();
            }
        }
    }

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
    <title>Cadastrar</title>
</head>
<body>
    <header><img src="imagens/webdec-home.png" alt="logo"></header>
    <h1>Novo cadastro</h1>
    <div class="conteiner-cadastro">
        <form action="" method="post">
            <div class="conteiner-cadastro">
                <legend class="legend-cadastro">Dados pessoais</legend>

                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" required class="conteiner-cadastro-input">

                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" required placeholder="123.456.789.10" class="conteiner-cadastro-input">

                <label for="rg">RG</label>
                <input type="text" id="rg" name="rg" required placeholder="12.345.789-1" class="conteiner-cadastro-input">

                <label for="data-nascimento">Data de nascimento</label>
                <input type="date" id="data-nascimento" name="data-nascimento" max="<?php echo date('Y-m-d') ?>" class="conteiner-cadastro-input" required>
            </div>
            <div class="conteiner-cadastro">
                <legend class="legend-cadastro">Endereço e contatos</legend>

                <label for="estado">ESTADO</label>
                <select name="estado" id="estado">
                    <?php foreach ($estados as $uf) : ?>
                        <option value="<?php echo $uf['id']; ?>"><?php echo $uf['uf']; ?></option>
                    <?php endforeach ?>
                </select>

                <label for="cep" class="conteiner-cadastro-input">CEP</label>
                <input type="text" id="cep" name="cep" required class="conteiner-cadastro-input">

                <label for="endereco">Endereço</label>
                <input type="text" id="endereco" name="endereco" required class="conteiner-cadastro-input">

                <label for="numero">Número</label>
                <input type="text" id="numero" name="numero" required class="conteiner-cadastro-input">

                <label for="telefone">Telefone</label>
                <input type="tel" id="telefone" name="telefone" placeholder="(21)98989-8989" class="conteiner-cadastro-input">

            </div>
            <input type="submit" class="butao-enviar-cadastro">

        </form>
    </div>
</body>
</html>