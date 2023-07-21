<?php
ob_start();

if (isset($_GET['error'])) {
    echo '<p>' . htmlspecialchars(urldecode($_GET['error'])) . '</p>';
}
?>

<form action="../controllers/ClienteController.php" method="post">
    <div class="row mt-4">
        <div class="form-group col-md-6">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" name="nome" id="nome" required value="<?php echo isset($_GET['nome']) ? htmlspecialchars(urldecode($_GET['nome'])) : ''; ?>">
        </div>
        <div class="form-group col-md-6">
            <label for="cpf">CPF:</label>
            <input type="text" class="form-control" name="cpf" id="cpf" required value="<?php echo isset($_GET['cpf']) ? htmlspecialchars(urldecode($_GET['cpf'])) : ''; ?>">
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="Cep">Cep:</label>
                <input type="text" class="form-control" name="cep" id="cep">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="Estado">Estado:</label>
                <input type="text" class="form-control" name="estado" id="estado">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="Cidadde">Cidade:</label>
                <input type="text" class="form-control" name="cidade" id="cidade">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="Bairro">Bairro:</label>
                <input type="text" class="form-control" name="bairro" id="bairro">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="Rua">Rua:</label>
                <input type="text" class="form-control" name="rua" id="rua">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="Numero">Número</label>
                <input type="text" class="form-control" name="numero" id="numero">
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

<script>

//Mascara
$(document).ready(function () {
    $('#cpf').inputmask('999.999.999-99');
    $("#cep").inputmask("99.999-999");
});


$(document).ready(function () {

$("#cep").on("change", function () {
    let cep = $(this).val().replace(/\D/g, '');
    console.log(cep)
    let url = `https://viacep.com.br/ws/${cep}/json/`;

    $.get(url, function (dados) {
        if (dados.erro) {
            alert("CEP não encontrado!");
        } else {
            exibirEndereco(dados);
        }
    })
        .fail(function () {
            alert("Erro ao buscar CEP!");
        });
});
});
function exibirEndereco(endereco) {

$("#bairro").val(endereco.bairro);
$("#rua").val(endereco.logradouro);
$("#cidade").val(endereco.localidade);
$("#estado").val(endereco.uf);
}

</script>