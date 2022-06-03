<?php

class Telefone
{
    //classe telefone
    private $mysql;
    private $idPessoa;
    private $numero;
    public function __construct(mysqli $mysql, string $idPessoa, string $numero)
    {
        $this->mysql = $mysql;
        $this->idPessoa = $idPessoa;
        $this->numero = $numero;
    }

    public function salvaTelefone()
    {
        //verificar se o telefone já está cadastrado, caso já esteja será atualizado
        $resultado = $this->mysql->query('SELECT id, pessoa_id FROM telefones');
        $consulta = $resultado->fetch_all(MYSQLI_ASSOC);

        foreach($consulta as $id) {
            if ($this->idPessoa === $id['pessoa_id']) {
                //ação
                $editar = $this->mysql->prepare('UPDATE telefones SET telefone = ? WHERE id = ?;');
                $editar->bind_param('ss', $this->numero, $id['id']);
                $editar->execute();
                return TRUE;
            }
        }
        $adicionar = $this->mysql->prepare('INSERT INTO telefones (pessoa_id, telefone) VALUES(?,?)');
        $adicionar->bind_param('ss', $this->idPessoa, $this->numero);
        $adicionar->execute();
    }

    public function validaTelefone()
    {
        //verificar se o telefone já está cadastrado
        $resultado = $this->mysql->query('SELECT id, pessoa_id, telefone FROM telefones');
        $consulta = $resultado->fetch_all(MYSQLI_ASSOC);

        $this->numero = preg_replace('/[^0-9]/', "", $this->numero);

        foreach($consulta as $telefone) {
            if ($this->numero === $telefone['telefone']) {
                //ação
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function cadastraTelefone()
    {
        $adicionar = $this->mysql->prepare('INSERT INTO telefones (pessoa_id, telefone) VALUES(?,?)');
        $adicionar->bind_param('ss', $this->idPessoa, $this->numero);
        $adicionar->execute();
    }
}
