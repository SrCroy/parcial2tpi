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

    public function datos(){
        $capital = $_POST['capital'];
        $interes = $_POST['i'];
        $plazos = $_POST['plazos'];


        $couta = ($capital * (($interes*(1+$interes)**$plazos))/(1+$interes)**$plazos-1);
        return $this->views("ResultadoView", [
            "capital" => $capital,
            "interes" => $interes,
            "plazos" => $plazos,
            "Couta" => $couta
        ]);
    }

}
?>