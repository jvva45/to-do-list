<?php

class User
{
    private $db;

    public function __construct($conexao)
    {
        $this->db = $conexao;
    }

    public function create($nome, $email, $senha_hash)
    {
        $sql = "INSERT INTO usuarios (nome, email, senha)
                VALUES (?, ?, ?)";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sss", $nome, $email, $senha_hash);

        return $stmt->execute();
    }

    public function findByEmail($email)
    {
        $sql = "SELECT id, nome, email, senha
                FROM usuarios
                WHERE email = ?
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }
}
