<?php
require_once "../modelo/categoria.php";
(!$_GET['op']) ?   die() : "";
$op = $_GET['op'];

$_POST = json_decode(file_get_contents('php://input'), true);

switch ($op) {
    case 1:
        showData();
        break;
    case 2:
        verifityTitle();
        break;
    case 3:
        add_categories();
        break;
    case 4:
        up_categories();
        break;
    case 5:
        eliminar_categoria();
        break;
}

function showData()
{
    $varaibles = categoria::listar_categorias();
    echo json_encode($varaibles);
}

function verifityTitle()
{
    $titulo = $_POST['titulo'];
    if ($titulo == "") {
        echo 2;
        die();
    }
    $variable = categoria::verificar_categoria($titulo);
    if ($variable == "") {
        echo 1;
    } else {
        echo 0;
    }
}

function add_categories()
{
    $array = [
        "titulo" => $_POST['titulo'],
        "url" => $_POST['url'],
        // "img"=>$_POST['img']
    ];
    echo categoria::ingresar_categoria($array);
}

function up_categories()
{
    $array = [
        "titulo" => $_POST['titulo'],
        "url" => $_POST['url'],
        "id" => $_POST['id']
    ];
    echo categoria::editar_categoria($array);
}

function eliminar_categoria(){
    echo categoria::borrar_categoria($_POST['id']);
}