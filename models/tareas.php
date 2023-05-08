<?php

class Tarea
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function todos()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM tareas');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM tareas WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertar($datos)
    {
        $stmt = $this->pdo->prepare('INSERT INTO tareas (nombre, descripcion, fecha_inicio, fecha_finalizacion, estado, id_proyecto) VALUES (:nombre, :descripcion, :fecha_inicio, :fecha_finalizacion, :estado, :id_proyecto)');
        $stmt->execute([
            'nombre' => $datos['nombre'],
            'descripcion' => $datos['descripcion'],
            'fecha_inicio' => $datos['fecha_inicio'],
            'fecha_finalizacion' => $datos['fecha_finalizacion'],
            'estado' => $datos['estado'],
            'id_proyecto' => $datos['id_proyecto']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function actualizar($id, $datos)
    {
        $stmt = $this->pdo->prepare('UPDATE tareas SET nombre = :nombre, descripcion = :descripcion, fecha_inicio = :fecha_inicio, fecha_finalizacion = :fecha_finalizacion, estado = :estado, id_proyecto = :id_proyecto WHERE id = :id');
        $stmt->execute([
            'id' => $id,
            'nombre' => $datos['nombre'],
            'descripcion' => $datos['descripcion'],
            'fecha_inicio' => $datos['fecha_inicio'],
            'fecha_finalizacion' => $datos['fecha_finalizacion'],
            'estado' => $datos['estado'],
            'id_proyecto' => $datos['id_proyecto']
        ]);
    }

    public function eliminar($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM tareas WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    // Agregar aquí otros métodos necesarios para el manejo de tareas
}
?>