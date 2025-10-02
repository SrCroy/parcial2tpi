<?php
namespace app\controllers;

class CoutaController{
    public function index(){
        return $this->views("CoutaView");
    }

    public function views($vista, $data=[]){
        //require_once("../app/views/$vista.php");
        extract($data);
        if (file_exists("../app/views/$vista.php")) {
            ob_start();
            include "../app/views/$vista.php";
            $content = ob_get_clean();
            return $content;
        }

        return "Hola desde la vista!!!!!";
    }

    public function enviarP(){
        $capital = $_POST['capital'];
        $interes = $_POST['i'];
        $plazos = $_POST['plazos'];

        return $this->views("ResultadoView", [
            "capital" => $capital,
            "i" => $interes,
            "plazos" => $plazos
        ]);
    }
}
?>