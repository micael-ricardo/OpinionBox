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

    public function updateCliente($id, $nome, $cpf, $cep, $estado, $cidade, $bairro, $rua, $numero)
    {
        if (empty($nome)) {
            throw new InvalidArgumentException('Nome inválido');
        }
        if (!Util::validaCPF($cpf)) {
            throw new InvalidArgumentException("CPF inválido");
        }

        try {
            $this->conexao->beginTransaction();

            $stmt = $this->conexao->prepare("UPDATE clientes SET nome = :nome, cpf = :cpf WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->execute();

            $stmt = $this->conexao->prepare("UPDATE bairros b SET b.nome_bairro = :bairro 
            WHERE b.id = (SELECT ceps.id_bairro FROM enderecos  INNER JOIN ceps 
            ON enderecos.id_cep = ceps.id WHERE enderecos.id_cliente = :id)");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':bairro', $bairro);
            $stmt->execute();

            $stmt = $this->conexao->prepare("UPDATE ceps SET cep = :cep WHERE id = (SELECT id_cep FROM enderecos WHERE id_cliente = :id)");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':cep', $cep);
            $stmt->execute();

            $stmt = $this->conexao->prepare("UPDATE enderecos SET rua = :rua, numero = :numero, cidade = :cidade, estado = :estado WHERE id_cliente = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':rua', $rua);
            $stmt->bindParam(':numero', $numero);
            $stmt->bindParam(':cidade', $cidade);
            $stmt->bindParam(':estado', $estado);
            $stmt->execute();

            $this->conexao->commit();
        } catch (Exception $e) {
            $this->conexao->rollBack();
            throw new Exception('Erro ao atualizar cliente: ' . $e->getMessage());
        }
    }

    public function deleteCliente($id)
    {
      try {
        $this->conexao->beginTransaction();
        $stmt = $this->conexao->prepare("DELETE FROM clientes WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $this->conexao->commit();
      } catch (Exception $e) {
        $this->conexao->rollBack();
        throw new Exception('Erro ao deletar usuário: ' . $e->getMessage());
      }
    }
}
