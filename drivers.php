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
<div style="position: absolute; right: 25px; top: 15px;"><a href="center.php">Список маршрутов</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="logout.php">Выход</a></div>
	<div style="float: right; width: 390px; margin-right: 60px; margin-top: 5px;">Во избежание утечки личных данных каждому машинисту присвоен секреный код. Посмотреть личные данные можно только при наличии этого кода.</div>
<input type="text" id="driver" placeholder="Имя машиниста" style="width: 300px;"/>
<br>
<input type="text" id="secret" placeholder="Секретный код" style="width: 300px;"/>
<a href="#" class="btn btn-success" id="look">Просмотр</a>
	<div style="padding-top: 30px; height: 100px; width: 730px; margin-top: 30px; border-top: 1px solid white;">

  <table style="width: 100%">
  </table>
	</div>
</div>
<!-- скрипты -->
<script src="other/jquery-1.10.2.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script>
$('#look').click(function() {
	$.ajax({ url: './info.php?driver='+encodeURIComponent($('#driver').val())+'&secret='+encodeURIComponent($('#secret').val()) }).done(function(data) {
		$('table').html(data);
	});
});
</script>
<!-- -->
</body>

</html>