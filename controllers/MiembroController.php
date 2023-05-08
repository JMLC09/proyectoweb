<?php

require_once '../models/Miembro.php';

class MiembroController
{
    protected $miembro;

    public function __construct(PDO $pdo)
    {
        $this->miembro = new Miembro($pdo);
    }

    public function index()
    {
        $miembros = $this->miembro->todos();
        require_once '../views/miembros/index.php';
    }

    public function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->miembro->insertar($_POST);
            header('Location: /miembros');
            exit();
        }
        require_once '../views/miembros/crear.php';
    }

    public function editar($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->miembro->actualizar($id, $_POST);
            header('Location: /miembros');
            exit();
        }
        $miembro = $this->miembro->buscarPorId($id);
        require_once '../views/miembros/editar.php';
    }

    public function eliminar($id)
    {
        $this->miembro->eliminar($id);
        header('Location: /miembros');
        exit();
    }
}

?>