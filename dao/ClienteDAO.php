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

    public function getAllUsers(): array
    {
        $stmt = $this->conexao->prepare("SELECT * FROM cliente");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertUser($nome, $cpf)
    {
        if (empty($nome)) {
            throw new InvalidArgumentException('Nome inválido');
        }
        if (!Util::validaCPF($cpf)) {
            throw new InvalidArgumentException("CPF inválido");
        }

        try {
            $this->conexao->beginTransaction();
            $stmt = $this->conexao->prepare("INSERT INTO cliente (Nome, Documento) VALUES (:nome, :cpf)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->execute();
            $this->conexao->commit();
        } catch (Exception $e) {
            $this->conexao->rollBack();
            throw new Exception('Erro ao inserir cliente: ' . $e->getMessage());
        }
    }

}
