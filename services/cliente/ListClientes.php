<?php

require_once __DIR__ . '/../../dao/ClienteDAO.php';

class ListClientes
{
    private $ClienteDAO;

    public function __construct()
    {
        $this->ClienteDAO = new ClienteDAO();
    }

    public function getAllClientes()
    {
        return $this->ClienteDAO->getAllClientes();
    }
}
