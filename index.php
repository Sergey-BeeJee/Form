<?php require 'data/db.php' ?><!-- <=== Connecting the config file and database and start session -->
<!-- Sergey Korobeynikov completed the test task for the company - national research University Higher school of Economics -->
<!-- Connecting the core -->
<!DOCTYPE html>
<html lang="ru">
<head>
	<title>Форма обратной связи</title>
	<!-- BootstrapCDN -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta charset="utf-8">
</head>
<body class="container">

	<!-- LogInButton and cheking login -->
	<?php if ( isset ($_SESSION['logged_user']) ) : ?>
		<a href="logout.php" class="btn btn-primary mt-3 mb-3 btn-lg active" role="button" aria-pressed="true">Выйти</a><br>
		<a href="allApp.php" aria-pressed="true">Все заявки</a>
	<?php else : ?>
		<a href="login.php" class="btn btn-primary mt-3 btn-lg active" role="button" aria-pressed="true">Войти</a>
		<small id="hint" class="mb-2 form-text text-muted">*Для администратора</small>
	<?php endif; ?>

	<!-- Block validation feedback -->
	<div id="valid" class="alert alert-danger invisible" role="alert"></div>
	<!-- Form send -->
	<form id="form">
	<!-- FullName -->
	  <div class="form-group">
	    <label for="Surname">Ф.И.О</label>
	    <input type="text" name='Surname' class="form-control" id="Surname" placeholder="Фамилия">
	  </div>
	  <div class="form-group">
	    <input type="text" name='firstName' class="form-control" id="firstName" placeholder="Имя">
	  </div>
	  <div class="form-group">
	    <input type="text" name='middleName' class="form-control" id="middleName" placeholder="Отчество">
	  </div>
	
	<!-- ContactInformation -->
	  <div class="mt-5 form-group">
	    <label for="Surname">Контактная информация</label>
	    <small id="hint2" class="mb-2 form-text text-muted">*Внимание! Ваши личные данные не будут опубликованы</small>
	    <input type="text" name='phone' class="phone form-control" id="numberPhone" placeholder="Номер телефона">
	  </div>
	  <div class="form-group">
	    <input type="email" name='email' class="form-control" id="email" placeholder="Email">
	  </div>
	
	<!-- DateTime -->
	  <div class="mt-5 mb-5 form-group">
	    <label for="Surname">Желаемая дата и время показа</label>
	    <input type="datetime-local" name='datatime' class="form-control" id="datatime">
	  </div>

	  <div class="form-group">
	    <label for="message">Сообщение</label>
	    <small id="hint3" class="mb-2 form-text text-muted">*Ваше сообщение отправится на почту администратора</small>
	    <textarea class="form-control" id="message" name="message" rows="3"></textarea>
	  </div>  

	  <button id="send" type="button" name='change' class="btn btn-success">Отправить</button>
	</form>



<!-- Jquery And Plugin MaskedInput -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>


<!-- MaskForPhone -->
<script>
	$( document ).ready(function() {
	    $(".phone").mask("+7(999)999-9999");
	});
</script>
<!-- ajax and validation script -->
<script src="js/ajaxSend.js"></script>

</body>
</html>