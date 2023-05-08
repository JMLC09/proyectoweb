<?php

require_once '../models/Tarea.php';

class TareaController
{
    protected $tarea;

    public function __construct(PDO $pdo)
    {
        $this->tarea = new Tarea($pdo);
    }

    public function index()
    {
        $tareas = $this->tarea->todos();
        require_once '../views/tareas/index.php';
    }

    public function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->tarea->insertar($_POST);
            header('Location: /tareas');
            exit();
        }
        require_once '../views/tareas/crear.php';
    }

    public function editar($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->tarea->actualizar($id, $_POST);
            header('Location: /tareas');
            exit();
        }
        $tarea = $this->tarea->buscarPorId($id);
        require_once '../views/tareas/editar.php';
    }

    public function eliminar($id)
    {
        $this->tarea->eliminar($id);
        header('Location: /tareas');
        exit();
    }
}


?>