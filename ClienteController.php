<?php
require_once 'Cliente.php';
require_once 'Util.php';

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];

// var_dump($_POST['cpf']);

$Cliente = new Cliente();
var_dump($Cliente);
$Cliente->insertUser($nome, $cpf);
// var_dump($Cliente);

