<?php
require_once 'Cliente.php';

$Cliente = new Cliente();
$clientes = $Cliente->getAllUsers();

foreach ($clientes as $row) {
  echo "ID: " . $row['id'] . "<br>";
  echo "Nome: " . $row['Nome'] . "<br>";
  echo "Documento: " . $row['Documento'] . "<br>";
  echo "<br>";
}
