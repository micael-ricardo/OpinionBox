<!DOCTYPE html>
<html>
<head>
    <title>Inserir Cliente</title>
</head>
<body>
    <form action="../controllers/ClienteController.php" method="post">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome"><br>
        <label for="cpf">CPF:</label><br>
        <input type="text" id="cpf" name="cpf"><br>
        <input type="submit" value="Inserir">
    </form>
</body>
</html>
