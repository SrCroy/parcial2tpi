<?php
use lib\Route;
use app\controllers\CoutaController;

Route::get("/", [CoutaController::class, "index"]);

Route::post("/enviar", [CoutaController::class, "enviarP"]);

Route::dispatch();
?>