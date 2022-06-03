<?php

require 'conexao.php';
require 'src/Cadastro.php';

$cadastro = new Cadastro($mysql);
$cadastros = $cadastro->exibirExcluidos();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cadastros excluídos</title>
</head>
<body>
    <header><img src="imagens/webdec-home.png" alt="logo"></header>
    <h1>Cadastros excluídos</h1>
    <nav>
        <a href="index.php" class="link-opcao">Home</a>
        <a href="cadastrar.php"><img height="25px" width="30px" src="imagens/adicionar.png" alt="icone-adicionar"></a>
    </nav>
    <div>
        <table>
            <thead>
                <tr>
                    <th>NOME</th><th>CPF</th><th>DATA/HORA DE CADASTRO</th><th>DATA/HORA DE EXCLUSÃO</th><th>EXCLUIR</th><th>RESTAURAR</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cadastros as $cadastro) : ?>
                    <tr>
                    <td><?php echo $cadastro['nome']; ?></td><td><?php echo $cadastro['cpf']; ?></td><td><?php echo $cadastro['data_cadastro']; ?></td><td><?php echo $cadastro['data_exclusao']; ?></td></td><td><a href="excluir-cadastro-banco.php?id=<?php echo $cadastro['id']; ?>"><img height="17px" width="20px" src="imagens/excluir.png" alt="icone-excluir"></a></td><td><a href="restaurar.php?id=<?php echo $cadastro['id']; ?>"><img height="20px" width="27px" src="imagens/user.png" alt="icone-cadastro"></a></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</body>
</html>