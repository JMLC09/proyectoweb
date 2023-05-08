<?php

class Relaciones
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function obtenerTareasPorProyecto($proyecto_id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM tareas WHERE proyecto_id = :proyecto_id');
        $stmt->execute(['proyecto_id' => $proyecto_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerMiembrosPorProyecto($proyecto_id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM miembros_proyectos WHERE proyecto_id = :proyecto_id');
        $stmt->execute(['proyecto_id' => $proyecto_id]);
        $miembros_proyectos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $miembros = [];

        foreach ($miembros_proyectos as $mp) {
            $stmt = $this->pdo->prepare('SELECT * FROM miembros WHERE id = :miembro_id');
            $stmt->execute(['miembro_id' => $mp['miembro_id']]);
            $miembros[] = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return $miembros;
    }

    public function obtenerComentariosPorTarea($tarea_id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM comentarios WHERE tarea_id = :tarea_id');
        $stmt->execute(['tarea_id' => $tarea_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>