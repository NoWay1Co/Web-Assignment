<?php 
$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);



$mysql = new mysqli('localhost', 'root', '', 'test');

$result = $mysql->query("SELECT * FROM `accounts` WHERE `login` = '$login' AND `pass` = '$pass'");
$user = $result->fetch_assoc(); // Конвертируем в массив
if(count($user) == 0){
	echo "Такой пользователь не найден.";
	exit();
}
else if(count($user) == 1){
	echo "Логин или пароль введены неверно";
	exit();
}

$mysql->close();

header('Location: afterLogin.html');

?>