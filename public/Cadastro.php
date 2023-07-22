<?php
ob_start();

if (isset($_GET['error'])) {
    echo '<p>' . htmlspecialchars(urldecode($_GET['error'])) . '</p>';
}

require_once __DIR__ . '/../services/cliente/EditCliente.php';

$editCliente = new EditCliente();
$cliente = [];
if (isset($_GET['id'])) {
    $cliente = $editCliente->getClienteById($_GET['id']);
}
?>

<?php if (isset($_GET['id'])) :  ?>
    <h1 class="display-6">Editar Cliente</h1>
<?php else : ?>
    <h1 class="display-6">Cadastrar Cliente</h1>
<?php endif ?>

<form action="../controllers/ClienteController.php" method="post">
    <div class="row mt-4">
        <div class="form-group col-md-6">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" name="nome" id="nome" required value="<?php echo isset($_GET['nome']) ? htmlspecialchars(urldecode($_GET['nome'])) : '';
                                                                                            echo $cliente['nome'] ?? ''; ?>">
        </div>
        <div class="form-group col-md-6">
            <label for="cpf">CPF:</label>
            <input type="text" class="form-control" name="cpf" id="cpf" required value="<?php echo isset($_GET['cpf']) ? htmlspecialchars(urldecode($_GET['cpf'])) : '';
                                                                                        echo $cliente['cpf'] ?? ''; ?>">
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="Cep">Cep:</label>
                <input type="text" class="form-control" name="cep" id="cep" required value="<?php echo isset($_GET['cep']) ? htmlspecialchars(urldecode($_GET['cep'])) : '';
                                                                                            echo $cliente['cep'] ?? ''; ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="Estado">Estado:</label>
                <input type="text" class="form-control" name="estado" id="estado" required value="<?php echo isset($_GET['estado']) ? htmlspecialchars(urldecode($_GET['estado'])) : '';
                                                                                                    echo $cliente['estado'] ?? ''; ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="Cidadde">Cidade:</label>
                <input type="text" class="form-control" name="cidade" id="cidade" required value="<?php echo isset($_GET['cidade']) ? htmlspecialchars(urldecode($_GET['cidade'])) : '';
                                                                                                    echo $cliente['cidade'] ?? ''; ?>">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="Bairro">Bairro:</label>
                <input type="text" class="form-control" name="bairro" id="bairro" required value="<?php echo isset($_GET['bairro']) ? htmlspecialchars(urldecode($_GET['bairro'])) : '';
                                                                                                    echo $cliente['nome_bairro'] ?? ''; ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="Rua">Rua:</label>
                <input type="text" class="form-control" name="rua" id="rua" required value="<?php echo isset($_GET['rua']) ? htmlspecialchars(urldecode($_GET['rua'])) : '';
                                                                                            echo $cliente['rua'] ?? ''; ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="Numero">Número</label>
                <input type="text" class="form-control" name="numero" id="numero" required value="<?php echo isset($_GET['numero']) ? htmlspecialchars(urldecode($_GET['numero'])) : '';
                                                                                                    echo $cliente['numero'] ?? ''; ?>">
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-5">
        <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Salvar </button>
        <a href="../public/listar.php" class="btn btn-danger"><i class="bi bi-trash"></i>Cancelar</a>
    </div>

</form>
</div>

<?php
$conteudo = ob_get_clean();
include 'template/layout.php';
?>

<script src="../public/js/Cliente.js"></script>