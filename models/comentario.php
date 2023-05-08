<?php

class Comentario
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function todos()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM comentarios');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM comentarios WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertar($datos)
    {
        $stmt = $this->pdo->prepare('INSERT INTO comentarios (texto, usuario_id, tarea_id) VALUES (:texto, :usuario_id, :tarea_id)');
        $stmt->execute([
            'texto' => $datos['texto'],
            'usuario_id' => $datos['usuario_id'],
            'tarea_id' => $datos['tarea_id']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function actualizar($id, $datos)
    {
        $stmt = $this->pdo->prepare('UPDATE comentarios SET texto = :texto WHERE id = :id');
        $stmt->execute([
            'texto' => $datos['texto'],
            'id' => $id
        ]);
        return $stmt->rowCount();
    }

    public function eliminar($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM comentarios WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount();
    }
}
