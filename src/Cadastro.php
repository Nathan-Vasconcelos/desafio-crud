<?php

Class Cadastro
{
    private $mysql;

    public function __construct(mysqli $mysql)
    {
        $this->mysql = $mysql;
    }

    public function exibirTodos(): array
    {
        $resultado = $this->mysql->query('SELECT id, nome, cpf, data_cadastro, data_atualizacao FROM pessoas WHERE data_exclusao IS NULL');
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function exibirExcluidos(): array
    {
        $resultado = $this->mysql->query('SELECT id, nome, cpf, data_cadastro, data_exclusao FROM pessoas WHERE data_exclusao IS NOT NULL');
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function pesquisarCadastro($filtro)
    {
        //pesquisar
        $filtro = '%' . $filtro . '%';
        $resultado = $this->mysql->prepare('SELECT id, nome, cpf, data_cadastro, data_atualizacao FROM pessoas WHERE nome LIKE ? AND data_exclusao IS NULL');
        $resultado->bind_param('s', $filtro);
        $resultado->execute();
        $resultadoPesquisa = $resultado->get_result()->fetch_all(MYSQLI_ASSOC);
        return $resultadoPesquisa;
    }

    public function exibirPorId(string $id): array
    {
        $resultado = $this->mysql->prepare("SELECT id, endereco_id, nome, cpf, rg, data_nascimento FROM pessoas WHERE id = ?");
        $resultado->bind_param('s', $id);
        $resultado->execute();
        $cadastro = $resultado->get_result()->fetch_assoc();
        return $cadastro;
    }

    public function exibirTelefonePorPessoa_id(string $id)
    {
        $resultado = $this->mysql->prepare("SELECT id, telefone FROM telefones WHERE pessoa_id = ?");
        $resultado->bind_param('s', $id);
        $resultado->execute();
        $telefone = $resultado->get_result()->fetch_assoc();
        return $telefone;
    }

    public function exibirCadastro(string $id)
    {
        $resultado = $this->mysql->prepare("SELECT pessoas.nome, pessoas.cpf, pessoas.rg, pessoas.data_nascimento, enderecos.estado_id, enderecos.endereco, enderecos.numero, enderecos.cep, estados.uf
        FROM pessoas JOIN enderecos ON enderecos.id = pessoas.endereco_id JOIN estados ON estados.id = enderecos.estado_id WHERE pessoas.id = ?");
        $resultado->bind_param('s', $id);
        $resultado->execute();
        $cadastro = $resultado->get_result()->fetch_assoc();
        return $cadastro;
    }

    public function exibirCadastroCompleto(string $id)
    {
        $resultado = $this->mysql->prepare("SELECT pessoas.nome, pessoas.cpf, pessoas.rg, pessoas.data_nascimento, pessoas.data_atualizacao, pessoas.data_cadastro, enderecos.endereco, enderecos.numero, enderecos.cep, estados.uf
        FROM pessoas JOIN enderecos ON enderecos.id = pessoas.endereco_id JOIN estados ON estados.id = enderecos.estado_id WHERE pessoas.id = ?;");
        $resultado->bind_param('s', $id);
        $resultado->execute();
        $cadastroCompleto = $resultado->get_result()->fetch_assoc();
        return $cadastroCompleto;
    }

    public function excluir($id)
    {
        //esclui, mas ainda pode ser resgatado
        date_default_timezone_set('America/Sao_Paulo');
        $dataexclusao = date('Y-m-d H:i:s');

        $editar = $this->mysql->prepare("UPDATE pessoas SET data_exclusao = ? WHERE id = ?;");
        $editar->bind_param('ss', $dataexclusao, $id);
        $editar->execute();
        
    }

    public function excluirTelefone(string $id): void
    {
        //excluir o telefone
        $excluir = $this->mysql->prepare('DELETE FROM telefones WHERE id = ?;');
        $excluir->bind_param('s', $id);
        $excluir->execute();
    }

    public function excluirCadastroDoBanco(string $id): void
    {
        //excluir cadastro do banco
        $excluir = $this->mysql->prepare('DELETE FROM pessoas WHERE id = ?;');
        $excluir->bind_param('s', $id);
        $excluir->execute();
    }

    public function restaurar($id)
    {
        $dataexclusao = null;

        $editar = $this->mysql->prepare("UPDATE pessoas SET data_exclusao = ? WHERE id = ?;");
        $editar->bind_param('ss', $dataexclusao, $id);
        $editar->execute();
        
    }
}
