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
<!-- панель управления -->
<div class="wrap panel-wrap" id="panel" style="position: relative; display: none;">
<div style="position: absolute; right: 25px; top: 15px;"><a href="paths.php">Подробная информация о маршруте</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="logout.php">Выход</a></div>
	<div class="input-append" style="padding-top: 5px;">
		<input type="text" id="search_text">
		<button id="search" type="submit" class="btn"><i class="icon-search"></i></button>
	</div>
	<div style="float: right; width: 450px; margin-right: 60px;">Здесь вы можете производить поиск по маршрутам. Введите пункт назначения (например, Moscow).</div>
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
	$('#err').text('Не удалось авторизоваться.').fadeIn(200);
}

$('input').focus(function() {
	$('#err').fadeOut(200);
});

$('#send').click(function() {
	if ($('#log').val() === '' || $('#pas').val() === '') {
		$('#err').text('Заполните все поля.').fadeIn(200);
		return false;
	}
	$.ajax({ url: './login.php?login='+encodeURIComponent($('#log').val())+'&password='+encodeURIComponent($('#pas').val()) }).done(function(data) {
		if (data === '1')
			loginSuccess();
		else
			loginError();
	});
});

function request() {
$('table').hide();
	$.ajax({ url: './trains.php?search='+encodeURIComponent($('#search_text').val()) }).done(function(data) {
		if (/\<tr\>/.test(data))
			$('table').css('color', 'white');
		else
			$('table').css('color', '#D68685');
		$('table').html(data);
		$('table').fadeIn(200);
	});
}

$('#search').click(request);
</script>
<!-- -->
</body>

</html>