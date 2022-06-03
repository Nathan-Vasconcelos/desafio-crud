<?php

class Endereco
{
    private $mysql;
    private $estadoId;
    private $cep;
    private $endereco;
    private $numero;

    public function __construct(mysqli $mysql, string $estadoId, string $cep, string $endereco, string $numero)
    {
        //construct
        $this->mysql = $mysql;
        $this->estadoId = $estadoId;
        $this->cep = $cep;
        $this->endereco = $endereco;
        $this->numero = $numero;
    }

    public function cadastrar(): void
    {
        $adicionar = $this->mysql->prepare('INSERT INTO enderecos (estado_id, cep, endereco, numero) VALUES(?,?,?,?);');
        $adicionar->bind_param('ssss', $this->estadoId, $this->cep, $this->endereco, $this->numero);
        $adicionar->execute();
        //return strval($idEnderecoCadastrada);
    }

    public function recuperaId()
    {
        $resultado = $this->mysql->prepare("SELECT id from enderecos where cep = ?");
        $resultado->bind_param('s', $this->cep);
        $resultado->execute();
        $id = $resultado->get_result()->fetch_assoc();
        return $id['id'];
    }

    public function editar($id): void
    {
        //update

        $editar = $this->mysql->prepare("UPDATE enderecos SET estado_id = ?, cep = ?, endereco = ?, numero = ? WHERE id = ?;");
        $editar->bind_param('sssss', $this->estadoId, $this->cep, $this->endereco, $this->numero, $id);
        $editar->execute();
    }

    public function editarPorCep($cep): void
    {
        //update

        $editar = $this->mysql->prepare("UPDATE enderecos SET estado_id = ?, cep = ?, endereco = ?, numero = ? WHERE cep = ?;");
        $editar->bind_param('sssss', $this->estadoId, $this->cep, $this->endereco, $this->numero, $cep);
        $editar->execute();
    }

    public function validaCep()
    {
        $resultado = $this->mysql->query('SELECT id, cep FROM enderecos');
        $consulta = $resultado->fetch_all(MYSQLI_ASSOC);

        foreach($consulta as $enderecos) {
            if ($this->cep === $enderecos['cep']) {
                //ação
                return FALSE;
            }
        }
        return TRUE;
    }
}
