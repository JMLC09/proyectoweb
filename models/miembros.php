<?php

class Miembro
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function todos()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM miembros');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM miembros WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertar($datos)
    {
        $stmt = $this->pdo->prepare('INSERT INTO miembros (nombre, apellido, correo_electronico, contraseña) VALUES (:nombre, :apellido, :correo_electronico, :contraseña)');
        $stmt->execute([
            'nombre' => $datos['nombre'],
            'apellido' => $datos['apellido'],
            'correo_electronico' => $datos['correo_electronico'],
            'contraseña' => $datos['contraseña'],
        ]);
        return $this->pdo->lastInsertId();
    }

    public function actualizar($id, $datos)
    {
        $stmt = $this->pdo->prepare('UPDATE miembros SET nombre = :nombre, apellido = :apellido, correo_electronico = :correo_electronico, contraseña = :contraseña WHERE id = :id');
        $stmt->execute([
            'id' => $id,
            'nombre' => $datos['nombre'],
            'apellido' => $datos['apellido'],
            'correo_electronico' => $datos['correo_electronico'],
            'contraseña' => $datos['contraseña'],
        ]);
        return $stmt->rowCount();
    }

    public function eliminar($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM miembros WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount();
    }
}

?>