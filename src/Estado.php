<?php

class Estado
{
    private $mysql;

    public function __construct(mysqli $mysql)
    {
        $this->mysql = $mysql;
    }

    public function exibirTodos(): array
    {
        //query
        $resultado = $this->mysql->query('SELECT id, uf FROM estados');
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}
