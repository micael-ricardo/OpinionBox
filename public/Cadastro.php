<!DOCTYPE html>
<html>

<head>
    <title>Inserir Cliente</title>
</head>
<?php
if (isset($_GET['error'])) {
    echo '<p>' . htmlspecialchars(urldecode($_GET['error'])) . '</p>';
}
?>
<body>
    <form action="../controllers/ClienteController.php" method="post">
        <label for="nome">Nome:</label><br>
        <input type="text" name="nome" value="<?php echo isset($_GET['nome']) ? htmlspecialchars(urldecode($_GET['nome'])) : ''; ?>"><br>
        <label for="cpf">CPF:</label><br>
        <input type="text" name="cpf" value="<?php echo isset($_GET['cpf']) ? htmlspecialchars(urldecode($_GET['cpf'])) : ''; ?>"><br>
        <input type="submit" value="Inserir">
    </form>
</body>

</html>