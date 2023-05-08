<?php

class Usuario
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function todos()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM usuarios');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Agregar aquí los métodos para insertar, actualizar y eliminar usuarios
    
    public function crear($datos)
    {
        $stmt = $this->pdo->prepare("INSERT INTO tareas (nombre, descripcion, fecha_inicio, fecha_fin, estado, id_proyecto) VALUES (:nombre, :descripcion, :fecha_inicio, :fecha_fin, :estado, :id_proyecto)");
        $stmt->execute($datos);
        return $this->pdo->lastInsertId();
    }
    
    public function actualizar($id, $datos)
    {
        $setStr = "";
        foreach ($datos as $key => $value) {
            $setStr .= "$key = :$key, ";
        }
        $setStr = rtrim($setStr, ", ");
    
        $stmt = $this->pdo->prepare("UPDATE tareas SET $setStr WHERE id = :id");
        $stmt->execute(array_merge(['id' => $id], $datos));
    }
    
    public function eliminar($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM tareas WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
    
}

?>