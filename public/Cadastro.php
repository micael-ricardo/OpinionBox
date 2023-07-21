<?php
ob_start();

if (isset($_GET['error'])) {
    echo '<p>' . htmlspecialchars(urldecode($_GET['error'])) . '</p>';
}
?>



<form action="../controllers/ClienteController.php" method="post">
    <div class="row mt-4">
        <div class="form-group col-md-4">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" name="nome" id="nome" required value="<?php echo isset($_GET['nome']) ? htmlspecialchars(urldecode($_GET['nome'])) : ''; ?>">
        </div>
        <div class="form-group col-md-4">
            <label for="cpf">CPF:</label>
            <input type="text" class="form-control" name="cpf" id="cpf" required value="<?php echo isset($_GET['cpf']) ? htmlspecialchars(urldecode($_GET['cpf'])) : ''; ?>">
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