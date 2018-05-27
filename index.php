<?php 
require_once("config.php");
/*$root = new Usuario();
$root->loadById(1);
echo $root;*/
//$lista = Usuario::getList();
//echo json_encode($lista);

//pesquisa
//$search = Usuario::search("Carlos");
//echo json_encode($search);

//Login
$usuario = new Usuario();
$usuario->login("Carlos", "Teste123456789");
echo $usuario;
?>