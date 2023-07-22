<?php

require_once __DIR__ . '/../../dao/ClienteDAO.php';

class CepBairro
{
    private $ClienteDAO;

    public function __construct()
    {
        $this->ClienteDAO = new ClienteDAO();
    }

    public function cepBairro()
    {
        return $this->ClienteDAO->cepBairro();
    }
}
