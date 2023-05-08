<?php

require_once '../models/Comentarios.php';

class ComentarioController
{
    protected $comentario;

    public function __construct(PDO $pdo)
    {
        $this->comentario = new Comentario($pdo);
    }

    public function index()
    {
        $comentarios = $this->comentario->todos();
        require_once '../views/comentarios/index.php';
    }

    public function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->comentario->insertar($_POST);
            header('Location: /comentarios');
            exit();
        }
        require_once '../views/comentarios/crear.php';
    }

    public function editar($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->comentario->actualizar($id, $_POST);
            header('Location: /comentarios');
            exit();
        }
        $comentario = $this->comentario->buscarPorId($id);
        require_once '../views/comentarios/editar.php';
    }

    public function eliminar($id)
    {
        $this->comentario->eliminar($id);
        header('Location: /comentarios');
        exit();
    }
}

?>
