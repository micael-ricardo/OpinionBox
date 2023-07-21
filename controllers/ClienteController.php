<?php
require_once __DIR__ . '/../services/cliente/InsertCliente.php';
require_once __DIR__ . '/../services/cliente/ListClientes.php';

function validarDados($dados) {
    $erros = [];

    if (empty($dados['nome'])) {
        $erros[] = 'Nome é obrigatório';
    }

    if (empty($dados['cpf'])) {
        $erros[] = 'CPF é obrigatório e deve ser numérico';
    }

    return $erros;
}

function tratarDados($dados) {
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
    header('Location: ../public/Cadastro.php?error=' . urlencode(implode(', ', $erros)));
    exit();
}

$dados = tratarDados($_POST);

$service = new InsertCliente();

try {
    $service->insertClientes($dados['nome'], $dados['cpf'], $dados['cep'], $dados['estado'], $dados['cidade'], $dados['bairro'], $dados['rua'], $dados['numero']);
    header('Location: ../public/Listar.php?message=' . urlencode('Cadastrado com sucesso'));
    exit();
} catch (Exception $e) {
    header('Location: ../public/Cadastro.php?error=' . urlencode('Erro ao inserir cliente: ' . $e->getMessage()) . '&nome=' . urlencode($nome) . '&cpf=' . urlencode($cpf));
    exit();
}
