<?php
ob_start();

require_once __DIR__ . '/../services/cliente/ListClientes.php';

if (isset($_GET['message'])) {
    echo '<p>' . htmlspecialchars(urldecode($_GET['message'])) . '</p>';
}
?>

<div class="input-group mt-3 mb-3">
    <div class="input-group-append">
        <a href="../public/cadastro.php" class="btn btn-success"><i class="bi bi-plus"></i> Adicionar</a>
    </div>
</div>


<?php
$listClientes = new ListClientes();
$clientes = $listClientes->getAllClientes();

foreach ($clientes as $cliente) {
    echo $cliente['Nome'] . ' - ' . $cliente['Documento'] . '<br>';
}

$conteudo = ob_get_clean();
include 'template/layout.php';
?>