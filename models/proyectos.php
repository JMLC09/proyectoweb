<?php

class Proyecto
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function todos()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM proyectos');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM proyectos WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Agregar aquí los métodos para insertar, actualizar y eliminar proyectos

    public function insertar($datos)
    {
        $stmt = $this->pdo->prepare('INSERT INTO proyectos (nombre, descripcion, fecha_inicio, fecha_finalizacion, estado) VALUES (:nombre, :descripcion, :fecha_inicio, :fecha_finalizacion, :estado)');
        $stmt->execute([
            'nombre' => $datos['nombre'],
            'descripcion' => $datos['descripcion'],
            'fecha_inicio' => $datos['fecha_inicio'],
            'fecha_finalizacion' => $datos['fecha_finalizacion'],
            'estado' => $datos['estado']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function actualizar($id, $datos)
    {
        $stmt = $this->pdo->prepare('UPDATE proyectos SET nombre = :nombre, descripcion = :descripcion, fecha_inicio = :fecha_inicio, fecha_finalizacion = :fecha_finalizacion, estado = :estado WHERE id = :id');
        $stmt->execute([
            'id' => $id,
            'nombre' => $datos['nombre'],
            'descripcion' => $datos['descripcion'],
            'fecha_inicio' => $datos['fecha_inicio'],
            'fecha_finalizacion' => $datos['fecha_finalizacion'],
            'estado' => $datos['estado']
        ]);
    }

    public function eliminar($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM proyectos WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

}

?>