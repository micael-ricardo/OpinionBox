$(document).ready(function () {
    $('.excluir').on('click', function () {
        var id = $(this).data('id');
        var nome = $(this).data('nome');
        $('#nome-usuario').text(nome);
        $('#formExcluir input[name="id"]').val(id);
    });
});

$(document).on("submit", "#formExcluir", function (e) {
    e.preventDefault();
    var form = this;

    function showError() {
        toastr.error('Ocorreu um erro ao excluir cliente.');
    }
    $.ajax({
        url: $(form).attr('action'),
        type: form.method,
        data: $(form).serialize(),
        success: function (response, status, xhr) {
            if (xhr.status === 200) {
                toastr.success('Cliente excluída com sucesso!');
                $('#ModalDeletar').modal('hide');
                setTimeout(function () {
                    location.reload();
                }, 1000);
            } else {
                showError();
            }
        },
        error: function (xhr) {
            showError();
        },
        complete: function () {
            $('#ModalDeletar').modal('hide');
        }
    });
});