<?php

require_once __DIR__ . '/../../dao/ClienteDAO.php';

class InsertCliente
{
    private $ClienteDAO;

    public function __construct()
    {
        $this->ClienteDAO = new ClienteDAO();
    }

    public function insertClientes($nome, $cpf, $cep, $estado, $cidade, $bairro, $rua, $numero)
    {
        $this->ClienteDAO->insertClientes($nome, $cpf, $cep, $estado, $cidade, $bairro, $rua, $numero);
    }
}
