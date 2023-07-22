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
                    <a title="Editar" href="Cadastro.php?id=<?php echo $cliente['id']; ?>" class="btn btn-info btn-sm"><i class="bi bi-pencil"></i></a>
                    <button title="Excluir" type="button" data-bs-target="#ModalDeletar" data-bs-toggle="modal" data-id="<?php echo $cliente['id']; ?>" data-nome="<?php echo $cliente['nome']; ?>" class="btn btn-danger btn-sm excluir"><i class="bi bi-trash"></i></button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="modal fade" id="ModalDeletar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Excluir Cliente</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="modal-body" class="modal-body">
                Tem certeza que deseja excluir Cliente: <b><span id="nome-usuario"> </span></b> ? Esta ação
                não pode ser desfeita.
            </div>
            <div class="modal-footer">
                <form id="formExcluir" method="post" action="../controllers/ClienteController.php">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id">
                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i>Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
$conteudo = ob_get_clean();
include 'template/layout.php';
?>
<script src="../public/js/DataTable.js"></script>
<script src="../public/js/Modal.js"></script>
