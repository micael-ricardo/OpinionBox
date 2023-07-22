<?php
ob_start();

require_once __DIR__ . '/../services/cliente/ListClientes.php';

if (isset($_GET['message'])) {
    echo '<p>' . htmlspecialchars(urldecode($_GET['message'])) . '</p>';
}
$listClientes = new ListClientes();
$clientes = $listClientes->getAllClientes();

?>

<link rel="stylesheet" type="text/css" href="css/DataTable.css">

<h1 class="display-6">Lista de Clientes</h1>

<div class="input-group mt-3 mb-3">
    <div class="input-group-append">
        <a href="../public/cadastro.php" class="btn btn-success"><i class="bi bi-plus"></i> Adicionar</a>
    </div>
</div>

<table id="clientes" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>CEP</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clientes as $cliente) : ?>
            <tr>
                <td><?php echo htmlspecialchars($cliente['nome']); ?></td>
                <td><?php echo htmlspecialchars($cliente['cpf']); ?></td>
                <td><?php echo htmlspecialchars($cliente['cep']); ?></td>
                <td>
                    <a href="Editar.php?id=<?php echo $cliente['id']; ?>" class="btn btn-info btn-sm"><i class="bi bi-pencil"></i></a>
                    <button type="button" data-id="<?php echo $cliente['id']; ?>" class="btn btn-danger btn-sm excluir-candidato"><i class="bi bi-trash"></i></button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
$conteudo = ob_get_clean();
include 'template/layout.php';
?>
<script src="../public/js/DataTable.js"></script>