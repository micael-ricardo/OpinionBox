<?php

require_once __DIR__ . '/../../dao/ClienteDAO.php';

class BairroCep
{
    private $ClienteDAO;

    public function __construct()
    {
        $this->ClienteDAO = new ClienteDAO();
    }

    public function bairroCep()
    {
        return $this->ClienteDAO->bairroCep();
    }
}
