<?php

require_once __DIR__ . '/../../dao/ClienteDAO.php';

class UpdatCliente
{
    private $ClienteDAO;

    public function __construct()
    {
        $this->ClienteDAO = new ClienteDAO();
    }

    public function updateCliente($id, $nome, $cpf, $cep, $estado, $cidade, $bairro, $rua, $numero)
    {
        return $this->ClienteDAO->updateCliente($id, $nome, $cpf, $cep, $estado, $cidade, $bairro, $rua, $numero);
    }
}
