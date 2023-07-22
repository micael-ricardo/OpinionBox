<?php
ob_start();
?>



<?php
$conteudo = ob_get_clean();
include '../template/layout.php';
?>