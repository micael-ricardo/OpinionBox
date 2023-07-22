
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
