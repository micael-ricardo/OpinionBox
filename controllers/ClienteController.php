<?php
require_once __DIR__ . '/../services/cliente/InsertCliente.php';
require_once __DIR__ . '/../services/cliente/ListClientes.php';

$RemoveMascara = preg_replace('/[^0-9]/', '',  $_POST['cpf']);

$nome = $_POST['nome'];
$cpf = $RemoveMascara;

if (empty($nome) || !is_numeric($cpf)) {
    header('Location: ../public/Cadastro.php?error=Nome ou CPF inválido');
    exit();
}

$service = new InsertCliente();
try {
    $service->insertClientes($nome, $cpf);
    header('Location: ../public/Listar.php?message=' . urlencode('Cadastrado com sucesso'));
    exit();
} catch (Exception $e) {
    header('Location: ../public/Cadastro.php?error=' . urlencode('Erro ao inserir cliente: ' . $e->getMessage()));
    exit();
}
