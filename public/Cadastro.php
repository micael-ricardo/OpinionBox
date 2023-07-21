<?php
ob_start();

if (isset($_GET['error'])) {
    echo '<p>' . htmlspecialchars(urldecode($_GET['error'])) . '</p>';
}
?>
<div class="input-group mt-3 mb-3">
    <form action="../controllers/ClienteController.php" method="post">
        <label for="nome">Nome:</label><br>
        <input type="text" name="nome" value="<?php echo isset($_GET['nome']) ? htmlspecialchars(urldecode($_GET['nome'])) : ''; ?>"><br>
        <label for="cpf">CPF:</label><br>
        <input type="text" name="cpf" value="<?php echo isset($_GET['cpf']) ? htmlspecialchars(urldecode($_GET['cpf'])) : ''; ?>"><br>

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