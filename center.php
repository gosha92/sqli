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
<div class="alert alert-success" id="alert"><strong>Вход выполнен!</strong> Добро пожаловать в информационный центр.</div>
<!-- панель управления -->
<div class="wrap panel-wrap" id="panel" style="position: relative;">
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