<?php 
	require 'data/db.php'; // <---- connection database
?>
<!DOCTYPE html>
<html>
<head>
	<title>Регистрация</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body class="container-fluid">
<?php
	//validation on php
	$data = $_POST;


	if ( isset($data['do_signup']) )
	{

		$errors = array();
		if ( trim($data['login']) == '' )
		{
			$errors[] = 'Введите логин';
		}

		if ( trim($data['email']) == '' )
		{
			$errors[] = 'Введите Email';
		}

		if ( $data['password'] == '' )
		{
			$errors[] = 'Введите пароль';
		}

		if ( $data['password_2'] != $data['password'] )
		{
			$errors[] = 'Повторный пароль введен не верно!';
		}

		if ( R::count('users', "login = ?", array($data['login'])) > 0)
		{
			$errors[] = 'Пользователь с таким логином уже существует!';
		}
    

		if ( R::count('users', "email = ?", array($data['email'])) > 0)
		{
			$errors[] = 'Пользователь с таким Email уже существует!';
		}

		if ( empty($errors) )
		{
			$user = R::dispense('users');
			$user->login = $data['login'];
			$user->email = $data['email'];
			$user->password = password_hash($data['password'], PASSWORD_DEFAULT);
			R::store($user);
			echo '<div class="alert alert-primary" role="alert">Вы успешно зарегистрированы!<br/><a href="login.php">Авторизуйтесь</a></div><hr>';
		}else
		{
			echo '<div id="errors" class="alert alert-danger" role="alert">' .array_shift($errors). '</div><hr>';
		}

	}

?>


	<!--Authorization form-->
	<form action="signin.php" method="POST">
	  <div class="form-group">
	    <label for="exampleInputEmail1">Логин</label>
	    <input type="text" name="login" value="<?php echo @$data['login']; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputEmail1">Ваш Email</label>
	    <input type="email" name="email" value="<?php echo @$data['email']; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputPassword1">Пароль</label>
	    <input type="password" name="password" value="<?php echo @$data['password']; ?>" class="form-control" id="exampleInputPassword1">
	  </div>
	  <div class="form-group">
	    <label for="exampleInputEmail1">Повторите пароль</label>
	    <input type="password" name="password_2" value="<?php echo @$data['password_2']; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
	  </div>
	  <button type="submit" class="btn btn-primary" name="do_signup">Регистрация</button>
	</form>
	<div class="mb-1 dropdown-divider"></div>
	<a href="/">На главную</a>

</body>
</html>