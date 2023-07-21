<?php
require_once 'Conexao.php';

class Cliente
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

}
