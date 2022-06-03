<?php

Class Pessoa
{
    private $mysql;
    private $enderecoId;
    private $nome;
    private $cpf;
    private $rg;
    private $dataNascimento;
    private $id;

    public function __construct(mysqli $mysql, string $nome, string $cpf, string $rg, string $dataNascimento)
    {
        $this->mysql = $mysql;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->rg = $rg;
        $this->dataNascimento = $dataNascimento;
        
    }
    public function recebeId($id): void
    {
        $this->id = $id;
    }

    public function recebeEnderecoId($enderecoId): void
    {
        $this->enderecoId = $enderecoId;
    }

    public function cadastrar()
    {
        //create
        $this->cpf = preg_replace('/[^0-9]/', "", $this->cpf);
        
        date_default_timezone_set('America/Sao_Paulo');
        $dataCadastro = date('Y-m-d H:i:s');
        $dataAtualizacao = date('Y-m-d H:i:s');

        $adicionar = $this->mysql->prepare('INSERT INTO pessoas (endereco_id, nome, cpf, rg, data_nascimento, data_cadastro, data_atualizacao) VALUES(?,?,?,?,?,?,?);');
        $adicionar->bind_param('sssssss', $this->enderecoId, $this->nome, $this->cpf, $this->rg, $this->dataNascimento, $dataCadastro, $dataAtualizacao);
        $adicionar->execute();
        $idPessoaCadastrada = mysqli_insert_id($this->mysql);
        return strval($idPessoaCadastrada);
    }

    public function exibirTodos(): array
    {
        //read
        $resultado = $this->mysql->query('SELECT id, nome, cpf, data_cadastro, data_atualizacao FROM pessoas');
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function editar(): void
    {
        //update

        date_default_timezone_set('America/Sao_Paulo');
        $dataAtualizacao = date('Y-m-d H:i:s');

        $editar = $this->mysql->prepare('UPDATE pessoas SET nome = ?, cpf = ?, rg = ?, data_nascimento = ?, data_atualizacao = ? WHERE id = ?;');
        $editar->bind_param('ssssss', $this->nome, $this->cpf, $this->rg, $this->dataNascimento, $dataAtualizacao, $this->id);
        $editar->execute();
    }

    public function validaCpf()
    {
        //verificando se o cpf existe no banco no banco

        $resultado = $this->mysql->query('SELECT id, cpf FROM pessoas');
        $consulta = $resultado->fetch_all(MYSQLI_ASSOC);

        $this->cpf = preg_replace('/[^0-9]/', "", $this->cpf);

        foreach($consulta as $pessoa) {
            if ($this->cpf === $pessoa['cpf']) {
                //ação
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

}
