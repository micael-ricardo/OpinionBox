<?php

class Conexao
{
  private $conexao;

  public function __construct()
  {
    try {
      $this->conexao = new PDO("mysql:dbname=opinion;host=localhost", "root", "");
      $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo "Erro na conexão com o banco de dados: " . $e->getMessage();
      exit();
    }
  }

  public function getConexao()
  {
    return $this->conexao;
  }
}

