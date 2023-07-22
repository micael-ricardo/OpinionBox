<?php
require_once '../config/Conexao.php';
require_once '../utils/Util.php';

class ClienteDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = (new Conexao())->getConexao();
    }

    public function getAllClientes(): array
    {

        $stmt = $this->conexao->prepare("SELECT c.id, c.nome, c.cpf, ce.cep, e.rua, e.numero, e.cidade, e.estado, b.nome_bairro
        FROM clientes c
        JOIN enderecos e ON c.id = e.id_cliente
        JOIN ceps ce ON e.id_cep = ce.id
        JOIN bairros b ON ce.id_bairro = b.id;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insertClientes($nome, $cpf, $cep, $estado, $cidade, $bairro, $rua, $numero)
    {
        if (empty($nome)) {
            throw new InvalidArgumentException('Nome inválido');
        }
        if (!Util::validaCPF($cpf)) {
            throw new InvalidArgumentException("CPF inválido");
        }

        try {
            $this->conexao->beginTransaction();
            $stmt = $this->conexao->prepare("INSERT INTO clientes (nome, cpf) VALUES (:nome, :cpf)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->execute();

            $id_cliente = $this->conexao->lastInsertId();

            $stmt = $this->conexao->prepare("INSERT INTO bairros (nome_bairro) VALUES (:bairro)");
            $stmt->bindParam(':bairro', $bairro);
            $stmt->execute();

            $id_bairro = $this->conexao->lastInsertId();

            $stmt = $this->conexao->prepare("INSERT INTO ceps (id_bairro, cep) VALUES (:id_bairro, :cep)");
            $stmt->bindParam(':id_bairro', $id_bairro);
            $stmt->bindParam(':cep', $cep);
            $stmt->execute();

            $id_cep = $this->conexao->lastInsertId();

            $stmt = $this->conexao->prepare("INSERT INTO enderecos (id_cliente, id_cep, rua, numero, cidade, estado) VALUES (:id_cliente, :id_cep, :rua, :numero, :cidade, :estado)");
            $stmt->bindParam(':id_cliente', $id_cliente);
            $stmt->bindParam(':id_cep', $id_cep);
            $stmt->bindParam(':rua', $rua);
            $stmt->bindParam(':numero', $numero);
            $stmt->bindParam(':cidade', $cidade);
            $stmt->bindParam(':estado', $estado);
            $stmt->execute();
            $this->conexao->commit();
        } catch (Exception $e) {
            $this->conexao->rollBack();
            throw new Exception('Erro ao inserir cliente: ' . $e->getMessage());
        }
    }

    public function getClienteById($id)
    {
        $stmt = $this->conexao->prepare("SELECT c.id, c.nome, c.cpf, ce.cep, e.rua, e.numero, e.cidade, e.estado, b.nome_bairro
        FROM clientes c
        JOIN enderecos e ON c.id = e.id_cliente
        JOIN ceps ce ON e.id_cep = ce.id
        JOIN bairros b ON ce.id_bairro = b.id
        WHERE c.id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
