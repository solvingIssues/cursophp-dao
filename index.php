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
/*$usuario = new Usuario();
$usuario->login("Carlos", "Teste123456789");
echo $usuario;*/

/*
Criar novo usuario
 $aluno = new Usuario("Aluno 2", "Aluno123456789");
$aluno->insert();
echo $aluno;*/

/*$usuario = new Usuario();
$usuario->loadById(1);
$usuario->update("Professor Carlos", "TesteCarlosProf");
echo $usuario;*/

$usuario = new Usuario();
$usuario->loadById(1);
$usuario->delete();
echo $usuario;
?>