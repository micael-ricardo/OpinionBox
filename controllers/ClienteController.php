<?php
require_once __DIR__ . '/../services/cliente/InsertCliente.php';

$RemoveMascara = preg_replace('/[^0-9]/', '',  $_POST['cpf']);

$nome = $_POST['nome'];
$cpf = $RemoveMascara;

$service = new InsertCliente();
$service->insertUser($nome, $cpf);

