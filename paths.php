<?php
@session_start();
if (!$_SESSION['logged']) header('Location: ./index.php');
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
<div class="alert alert-success" id="alert"><strong>Вход выполнен! </strong> <?php echo $_SESSION['login'] ?>, добро пожаловать в информационный центр.</div>
<!-- панель управления -->
<div class="wrap panel-wrap" id="panel" style="position: relative; padding-top: 70px;">
<div style="position: absolute; right: 25px; top: 15px;"><a href="center.php">Список маршрутов</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="logout.php">Выход</a></div>
	<div style="float: right; width: 390px; margin-right: 60px; margin-top: 15px;">Чтобы посмотреть подробную информацию о маршруте, необходимо ввести специальный код.</div>
<input type="text" id="number" placeholder="Номер маршрута" style="width: 300px;"/>
<br>
<input type="text" id="secret" placeholder="Секретный код" style="width: 300px;"/>
<a href="#" class="btn btn-success" id="look">Просмотр</a>
	<div style="padding-top: 30px; height: 100px; width: 730px; margin-top: 30px; border-top: 1px solid white;">

	<div id="main_content">
	<table>
	<tr><td>Машинист:</td><td>Иван Петров</td></tr>
	<tr><td>Время в пути:</td><td>12:04:33</td></tr>
	<tr><td>Количество вагонов:</td><td>14</td></tr>
	<tr><td>Номер для связи:</td><td>11-098-115</td></tr>
	</table>
	<img src="./images/1.jpg" />
	</div>

	</div>
</div>
<!-- скрипты -->
<script src="other/jquery-1.10.2.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script>
function search() {
	if ($('#number').val() === '' || $('#secret').val() === '') {
		$('#main_content').hide();
		$('#main_content').css('color', '#D68685').html('Заполните все поля.').fadeIn(200);
		return false;
	}
	$('#main_content').hide();
	$.ajax({ url: './info.php?number='+encodeURIComponent($('#number').val())+'&secret='+encodeURIComponent($('#secret').val()) }).done(function(data) {
		if (/\<td\>/.test(data))
			$('#main_content').css('color', 'white');
		else
			$('#main_content').css('color', '#D68685');
		$('#main_content').html(data).fadeIn(200);
	});
}

$('#look').click(search);
$('input').keypress(function(e){if(e.which == 13) {
	search();
}});

$(function(){
	$('#number').focus()
});
</script>
<!-- -->
</body>

</html>