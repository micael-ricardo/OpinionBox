<?php

require_once __DIR__ . '/../services/cliente/ListClientes.php';

if (isset($_GET['message'])) {
    echo '<p>' . htmlspecialchars(urldecode($_GET['message'])) . '</p>';
}

$listClientes = new ListClientes();
$clientes = $listClientes->getAllClientes();

foreach ($clientes as $cliente) {
    echo $cliente['Nome'] . ' - ' . $cliente['Documento'] . '<br>';
}
