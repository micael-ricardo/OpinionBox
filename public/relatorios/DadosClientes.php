<?php
ob_start();

require_once __DIR__ . '/../../services/cliente/ListClientes.php';

if (isset($_GET['message'])) {
    echo '<p>' . htmlspecialchars(urldecode($_GET['message'])) . '</p>';
}
$listClientes = new ListClientes();
$clientes = $listClientes->getAllClientes();
?>

<link rel="stylesheet" type="text/css" href="/Opinion/public/css/DataTable.css">

<h1 class="display-6">Dados Do Cliente</h1>

<table id="clientes" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>id</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>CEP</th>
            <th>Endereço</th>
            <th>Número</th>
            <th>Bairro</th>
            <th>Cidade</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clientes as $cliente) : ?>
            <tr>
                <td><?php echo htmlspecialchars($cliente['id']); ?></td>
                <td><?php echo htmlspecialchars($cliente['nome']); ?></td>
                <td><?php echo htmlspecialchars($cliente['cpf']); ?></td>
                <td><?php echo htmlspecialchars($cliente['cep']); ?></td>
                <td><?php echo htmlspecialchars($cliente['rua']); ?></td>
                <td><?php echo htmlspecialchars($cliente['numero']); ?></td>
                <td><?php echo htmlspecialchars($cliente['nome_bairro']); ?></td>
                <td><?php echo htmlspecialchars($cliente['cidade']); ?></td>
                <td><?php echo htmlspecialchars($cliente['estado']); ?></td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
$conteudo = ob_get_clean();
include '../template/layout.php';
?>

<script src="/Opinion/public/js/DataTable.js"></script>