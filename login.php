<?php
 
// inclui o arquivo de inicialização
require 'init.php';
 //header('Content-Type: application/x-www-form-urlencoded; charset=utf-8');
// resgata variáveis do formulário
$login = isset($_POST['login']) ? $_POST['login'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
 
if (empty($login) || empty($password))
{	
    echo 2;
    exit;
}
 
// cria o hash da senha
$passwordHash = make_hash($password);
 
$PDO = db_connect();
 	
$sql = "SELECT id, name, fknivel FROM users WHERE login = :login AND password = :password";
$stmt = $PDO->prepare($sql);
 
$stmt->bindParam(':login', $login);
$stmt->bindParam(':password', $passwordHash);
 
$stmt->execute();
 
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);	
 
if (count($users) <= 0)
{
	var_dump($_POST);
	var_dump($login);
	var_dump($password);
    echo 0;
    exit;
}
// pega o primeiro usuário
echo 1;
$user = $users[0];

session_start();
$_SESSION['nivel'] = $user['fknivel'];
$_SESSION['logged_in'] = true;
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['name'];
 
//header('Location: index.php');