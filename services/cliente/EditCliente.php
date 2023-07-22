<?php

require_once __DIR__ . '/../../dao/ClienteDAO.php';

class EditCliente
{
    private $ClienteDAO;

    public function __construct()
    {
        $this->ClienteDAO = new ClienteDAO();
    }

    public function getClienteById($id)
    {
        return $this->ClienteDAO->getClienteById($id);
    }
}
