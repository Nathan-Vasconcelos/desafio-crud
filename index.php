<?php

require 'conexao.php';
require 'src/Cadastro.php';

$cadastro = new Cadastro($mysql);
$cadastros = $cadastro->exibirTodos();

if (isset($_GET['filtro']) and $_GET['filtro'] != '') {
    $cadastros = $cadastro->pesquisarCadastro($_GET['filtro']);
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>home page</title>
</head>
<body>
    <header><img src="imagens/webdec-home.png" alt="logo"></header>
    <h1>Home page</h1>
    <form action="" method="get">
        <input type="search" placeholder="pesquise pelo nome" name="filtro">
        <input type="submit" class="butao-enviar">
    </form>
    
    <nav>
        <a href="index.php" class="link-opcao">Home</a>
        <a href="cadastros-excluidos.php" class="link-opcao">Cadastros excluídos</a>
        <a href="cadastrar.php"><img height="25px" width="30px" src="imagens/adicionar.png" alt="icone-adicionar"></a>
    </nav>
    <div>
        <table>
            <thead>
                <tr>
                    <th>NOME</th><th>CPF</th><th>DATA/HORA DE CADASTRO</th><th>DATA/HORA DE ATUALIZAÇÃO</th><th>EDITAR</th><th>EXCLUIR</th><th>CADASTRO</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cadastros as $cadastro) : ?>
                    <tr>
                    <td><?php echo $cadastro['nome']; ?></td><td><?php echo $cadastro['cpf']; ?></td><td><?php echo $cadastro['data_cadastro']; ?></td><td><?php echo $cadastro['data_atualizacao']; ?></td><td><a href="editar.php?id=<?php echo $cadastro['id']; ?>"><img height="17px" width="20px" src="imagens/editar.png" alt="icone-editar"></a></td><td><a href="excluir.php?id=<?php echo $cadastro['id']; ?>"><img height="17px" width="20px" src="imagens/excluir.png" alt="icone-excluir"></a></td><td><a href="cadastro-completo.php?id=<?php echo $cadastro['id']; ?>"><img height="20px" width="27px" src="imagens/user.png" alt="icone-cadastro"></a></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</body>
</html>