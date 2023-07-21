<?php
require_once 'Cliente.php';
require_once 'Util.php';

$RemoveMascara = preg_replace('/[^0-9]/', '',  $_POST['cpf']);

$nome = $_POST['nome'];
$cpf = $RemoveMascara;

$Cliente = new Cliente();
$Cliente->insertUser($nome, $cpf);

