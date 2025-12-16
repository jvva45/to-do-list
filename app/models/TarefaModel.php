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

    public function deletarTarefa($tarefaId, $usuarioId)
    {
        $sql = "DELETE FROM tarefas WHERE id = $tarefaId AND usuario_id = $usuarioId";
        return mysqli_query($this->db, $sql);
    }
    public function concluirTarefa($tarefaId, $usuarioId)
    {
        $sql = "UPDATE tarefas SET status = 'concluida' WHERE id = $tarefaId AND usuario_id = $usuarioId";
        return mysqli_query($this->db, $sql);
    }
    public function buscarTarefaPorId($id, $usuarioId)
    {
        $sql = "SELECT * FROM tarefas 
            WHERE id = ? AND usuario_id = ?
            LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $id, $usuarioId);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function atualizarTarefa($id, $usuarioId, $titulo, $descricao, $status, $data_limite)
    {
        $titulo = $this->db->real_escape_string($titulo);
        $descricao = $this->db->real_escape_string($descricao);
        $status = $this->db->real_escape_string($status);
        $data_limite = $this->db->real_escape_string($data_limite);

        $sql = "
            UPDATE tarefas 
            SET titulo = '$titulo', descricao = '$descricao', status = '$status', data_limite = '$data_limite' 
            WHERE id = $id AND usuario_id = $usuarioId
        ";

        return mysqli_query($this->db, $sql);
    }
}
