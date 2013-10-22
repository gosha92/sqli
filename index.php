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
<div class="alert" id="alert"><strong>Внимание!</strong> Если вы не являетесь сотрудником вокзала, то немедленно покиньте эту страницу!</div>
<!-- форма авторизации -->
<div id="login-block">
	<div class="wrap" style="width: 300px; position: relative;">
		<div id="err" class="alert alert-error" style="display: none; position: absolute; top: -30px; left: 200px; width: 270px;"><strong>Ошибка!</strong> Неверно введен логин или пароль. Попробуйте еще раз.</div>
		<h5 style="color: white;">Введите ваши данные:</h5>
		<br>
		<input id="log" type="text" name="login" placeholder="Логин"/>
		<br>
		<input id="pas" type="password" name="password" placeholder="Пароль"/>
		<br>
		<br>
		<a href="#" class="btn btn-success" id="send">ВОЙТИ</a>
	</div>
</div>
<!-- панель управления -->
<div class="wrap panel-wrap" id="panel" style="position: relative; display: none;">
<div style="position: absolute; right: 25px; top: 15px;"><a href="drivers.php">Личные данные машинистов</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="logout.php">Выход</a></div>
	<div class="input-append" style="padding-top: 5px;">
		<input type="text" id="search_text">
		<button id="search" type="submit" class="btn"><i class="icon-search"></i></button>
	</div>
	<div style="float: right; width: 450px; margin-right: 60px;">Здесь вы можете производить поиск по маршрутам. Введите пункт отбытия (например, Moscow).</div>
	<div style="padding-top: 30px; height: 100px; width: 730px; margin-top: 30px; border-top: 1px solid white;">

  <table style="width: 100%">
  </table>
	</div>
</div>
<!-- скрипты -->
<script src="other/jquery-1.10.2.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script>
function loginSuccess() {
	$('#alert').addClass('alert-success').html('<strong>Вход выполнен!</strong> Добро пожаловать в информационный центр.');
	$('#login-block').fadeOut(function() {
		$('#panel').fadeIn();
	});
}
function loginError() {
	$('#err').hide();
	$('#err').fadeIn(200);
}

$('#send').click(function() {
	$.ajax({ url: './login.php?login='+encodeURIComponent($('#log').val())+'&password='+encodeURIComponent($('#pas').val()) }).done(function(data) {
		if (data === '1')
			loginSuccess();
		else
			loginError();
	});
});

$('#search').click(function() {
	$.ajax({ url: './trains.php?search='+encodeURIComponent($('#search_text').val()) }).done(function(data) {
		$('table').html(data);
	});
});
</script>
<!-- -->
</body>

</html>