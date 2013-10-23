<?php
@session_start();
if ($_SESSION['logged']) header('Location: ./center.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Информационный центр</title>
	<meta charset="utf-8">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="other/style.css" rel="stylesheet">
</head>

<body>
<!-- полоса состояния -->
<br><br>
<div class="alert" id="alert"><strong>Внимание!</strong> Эта страница только для сотрудников вокзала.</div>
<!-- форма авторизации -->
<div id="login-block">
	<div class="wrap" style="width: 300px; position: relative;">
		<h5 style="color: white;">Введите ваши данные:</h5>
		<br>
		<input id="log" type="text" name="login" placeholder="Логин"/>
		<br>
		<input id="pas" type="password" name="password" placeholder="Пароль"/>
		<br>
		<br>
		<a href="#" class="btn btn-success" id="send">ВОЙТИ</a><p id="err" style="float: right; width: 130px; margin-right: 80px; margin-top: -5px; color: #D68685; display: none;">Не удалось авторизоваться.</p>
	</div>
</div>
<!-- скрипты -->
<script src="other/jquery-1.10.2.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script>

function login() {
	$('#err').hide();
	if ($('#log').val() === '' || $('#pas').val() === '') {
		$('#err').text('Заполните все поля.').fadeIn(200);
		return false;
	}
	$.ajax({ url: './login.php?login='+encodeURIComponent($('#log').val())+'&password='+encodeURIComponent($('#pas').val()) }).done(function(data) {
		if (data === '0')
			$('#err').text('Не удалось авторизоваться.').fadeIn(200);
		else
			window.location = './center.php';
	});
}

$('#send').click(login);
$('input').keypress(function(e){if(e.which == 13) {
	login();
}});

$('input').focus(function() {
	$('#err').fadeOut(200);
});
</script>
<!-- -->
</body>

</html>