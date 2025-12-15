<?php

class TarefaModel
{
    private $db;

    public function __construct($conexao)
    {
        $this->db = $conexao;
    }

    public function listarTarefas($usuarioId, $filtro = null, $busca = null)
    {
        $sql = "SELECT * FROM tarefas WHERE usuario_id = $usuarioId";

        if ($filtro === 'pendente') {
            $sql .= " AND status = 'pendente'";
        } elseif ($filtro === 'concluida') {
            $sql .= " AND status = 'concluida'";
        }
        
        if (!empty($busca)) {
            $busca = $this->db->real_escape_string($busca);
            $sql .= " AND titulo LIKE '%$busca%'";
        }

        $sql .= " ORDER BY data_limite";

        return mysqli_query($this->db, $sql);
    }


    public function salvarTarefa($usuarioId, $titulo, $descricao, $status, $data_criacao, $data_limite)
    {
        $titulo = $this->db->real_escape_string($titulo);
        $descricao = $this->db->real_escape_string($descricao);
        $status = $this->db->real_escape_string($status);
        $data_criacao = $this->db->real_escape_string($data_criacao);
        $data_limite = $this->db->real_escape_string($data_limite);

        $sql = "
            INSERT INTO tarefas 
            (usuario_id, titulo, descricao, status, data_criacao, data_limite)
            VALUES 
            ($usuarioId, '$titulo', '$descricao', '$status', '$data_criacao', '$data_limite')
        ";

        return mysqli_query($this->db, $sql);
    }
}
