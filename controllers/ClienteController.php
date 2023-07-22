<?php
require_once __DIR__ . '/../services/cliente/InsertCliente.php';
require_once __DIR__ . '/../services/cliente/ListClientes.php';
require_once __DIR__ . '/../services/cliente/UpdatCliente.php';
require_once __DIR__ . '/../services/cliente/DeletCliente.php';


function deleteCliente($id)
{
    var_dump("Entrou");
    $service = new DeletCliente();
    var_dump($service);
    try {
        $service->deleteCliente($id);
        header('Location: ../public/Listar.php?message=' . urlencode('Excluído com sucesso'));
        exit();
    } catch (Exception $e) {
        header('Location: ../public/Listar.php?error=' . urlencode('Erro ao excluir cliente: ' . $e->getMessage()));
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'delete') {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            deleteCliente($_POST['id']);
        } else {
            header('Location: ../public/Listar.php?error=' . urlencode('ID do cliente não fornecido'));
            exit();
        }
    } else {
        function validarDados($dados)
        {
            $erros = [];

            if (empty($dados['nome'])) {
                $erros[] = 'Nome é obrigatório';
            }

            if (empty($dados['cpf'])) {
                $erros[] = 'CPF é obrigatório';
            }

            if (empty($dados['cep'])) {
                $erros[] = 'CEP é obrigatório';
            }

            if (empty($dados['numero']) || !is_numeric($dados['numero'])) {
                $erros[] = 'Número é obrigatório e deve ser númerico';
            }

            return $erros;
        }

        function tratarDados($dados)
        {
            $dadosTratados = [];

            $dadosTratados['nome'] = $dados['nome'];
            $dadosTratados['cpf'] = preg_replace('/[^0-9]/', '',  $dados['cpf']);
            $dadosTratados['cep'] = preg_replace('/[^0-9]/', '',  $dados['cep']);
            $dadosTratados['estado'] = $dados['estado'];
            $dadosTratados['cidade'] = $dados['cidade'];
            $dadosTratados['bairro'] = $dados['bairro'];
            $dadosTratados['rua'] = $dados['rua'];
            $dadosTratados['numero'] = $dados['numero'];

            return $dadosTratados;
        }

        $erros = validarDados($_POST);

        if (!empty($erros)) {
            header('Location: ../public/Cadastro.php?error=' . urlencode(implode(', ', $erros))
                . '&nome=' . urlencode($_POST['nome']) . '&cpf=' . urlencode($_POST['cpf'])
                . '&cep=' . urlencode($_POST['cep']) . '&estado=' . urlencode($_POST['estado'])
                . '&cidade=' . urlencode($_POST['cidade']) . '&bairro=' . urlencode($_POST['bairro'])
                . '&rua=' . urlencode($_POST['rua']) . '&numero=' . urlencode($_POST['numero']));
            exit();
        }

        $dados = tratarDados($_POST);

        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $service = new UpdatCliente();
            try {
                $service->updateCliente($_POST['id'], $dados['nome'], $dados['cpf'], $dados['cep'], $dados['estado'], $dados['cidade'], $dados['bairro'], $dados['rua'], $dados['numero']);
                header('Location: ../public/Listar.php?message=' . urlencode('Atualizado com sucesso'));
                exit();
            } catch (Exception $e) {
                header('Location: ../public/Cadastro.php?error=' . urlencode('Erro ao atualizar cliente: ' . $e->getMessage())
                    . '&nome=' . urlencode($_POST['nome']) . '&cpf=' . urlencode($_POST['cpf'])
                    . '&cep=' . urlencode($_POST['cep']) . '&estado=' . urlencode($_POST['estado'])
                    . '&cidade=' . urlencode($_POST['cidade']) . '&bairro=' . urlencode($_POST['bairro'])
                    . '&rua=' . urlencode($_POST['rua']) . '&numero=' . urlencode($_POST['numero']));
                exit();
            }
        } else {
            $service = new InsertCliente();
            try {
                $service->insertClientes($dados['nome'], $dados['cpf'], $dados['cep'], $dados['estado'], $dados['cidade'], $dados['bairro'], $dados['rua'], $dados['numero']);
                header('Location: ../public/Listar.php?message=' . urlencode('Cadastrado com sucesso'));
                exit();
            } catch (Exception $e) {
                header('Location: ../public/Cadastro.php?error=' . urlencode('Erro ao inserir cliente: ' . $e->getMessage())
                    . '&nome=' . urlencode($_POST['nome']) . '&cpf=' . urlencode($_POST['cpf'])
                    . '&cep=' . urlencode($_POST['cep']) . '&estado=' . urlencode($_POST['estado'])
                    . '&cidade=' . urlencode($_POST['cidade']) . '&bairro=' . urlencode($_POST['bairro'])
                    . '&rua=' . urlencode($_POST['rua']) . '&numero=' . urlencode($_POST['numero']));
                exit();
            }
        }
    }
}
