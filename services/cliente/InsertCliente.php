<?php

require_once __DIR__ . '/../../dao/ClienteDAO.php';

class InsertCliente
{
    private $ClienteDAO;

    public function __construct()
    {
        $this->ClienteDAO = new ClienteDAO();
    }

    public function insertUser($nome, $cpf)
    {
        $this->ClienteDAO->insertUser($nome, $cpf);
    }
}
