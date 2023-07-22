<?php

require_once __DIR__ . '/../../dao/ClienteDAO.php';

class DeletCliente
{
    private $ClienteDAO;

    public function __construct()
    {
        $this->ClienteDAO = new ClienteDAO();
    }

    public function deleteCliente($id)
    {
        return $this->ClienteDAO->deleteCliente($id);
    }
}
