<?php
use app\controllers\Nuevo;
use lib\Route;
use app\controllers\CoutaController;

//Route::post("/jl", [CoutaController::class, "datos"]);
Route::get("/", [CoutaController::class, "index"]);
Route::get("/nuevo", function(){
    return "Hola";
});

Route::dispatch();
?>