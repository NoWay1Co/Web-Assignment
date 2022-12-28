<?php 

$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING); // Удаляет все лишнее и записываем значение в переменную //$login
$pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);

if(mb_strlen($login) < 3 || mb_strlen($login) > 64){
	echo "Недопустимая длина логина";
	exit();
}
else if(mb_strlen($email) < 5){
	echo "Неправильная почта";
	exit();
} // Проверяем длину почты



$mysql = new mysqli('localhost', 'root', '', 'test');

$result1 = $mysql->query("SELECT * FROM `accounts` WHERE `login` = '$login'");
$user1 = $result1->fetch_assoc(); // Конвертируем в массив
if(!empty($user1)){
	echo "Данный логин уже используется!";
	exit();
}
else {
	$mysql->query("INSERT INTO `accounts` (`login`, `pass`, `email`)
		VALUES('$login', '$pass', '$email')");
	$mysql->close();
}


header('Location: /');
exit();
 ?>