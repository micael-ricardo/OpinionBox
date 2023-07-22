<?php
ob_start();

require_once __DIR__ . '/../../services/cliente/BairroCep.php';

if (isset($_GET['message'])) {
    echo '<p>' . htmlspecialchars(urldecode($_GET['message'])) . '</p>';
}
$BairroCep = new BairroCep();
$bairroceps = $BairroCep->bairroCep();
?>

<link rel="stylesheet" type="text/css" href="/Opinion/public/css/DataTable.css">

<h1 class="display-6"> Bairros com mais de um CEP </h1>

<table id="clientes" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Bairro</th>
            <th>Quantidade de Ceps</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($bairroceps as $bairrocep) : ?>
            <tr>
                <td><?php echo htmlspecialchars($bairrocep['nome_bairro']); ?></td>
                <td><?php echo htmlspecialchars($bairrocep['quantidade_ceps']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
$conteudo = ob_get_clean();
include '../template/layout.php';
?>

<script src="/Opinion/public/js/DataTable.js"></script>