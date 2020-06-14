<?php require 'data/db.php' //<----Connecting the DataBase?>
<!DOCTYPE html>
<html>
<head>
	<title>Все заявки</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<!-- enabling boostrap styles -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body class="container">
	<!-- checking for authorization via cookies -->
	<?php if ( isset ($_SESSION['logged_user']) ) : ?>
		<a href="logout.php" class="btn btn-primary mt-3 mb-3 btn-lg active" role="button" aria-pressed="true">Выйти</a><br>
		<a href="index.php" aria-pressed="true">На главную</a>
<!-- response block -->
<nav aria-label="Page navigation example">
	<ul class="mt-2 pagination justify-content-center">
		<?php
		//pagination output script
			$answerCount = R::count( 'answers' );
			//determining the page number
			$page = isset($_GET['page']) ? $_GET['page'] : 1;
			//limit items for page
			$limit = 3;
			//offset in output data
			$offset = $limit * ($page - 1);
			//number of pagination pages
			$numPagePag = $answerCount / $limit;
			//prev page
			$prev = $page - 1;
			//next page
			$next = $page + 1;

			//pagination script, displaying buttons depending on the user's position on a particular page
			if ( $numPagePag != 0 ){
				if ( $page != 1 ) {
					echo '<li class="page-item"><a class="page-link" href="allApp.php?page='.$prev.'">Предыдущая</a></li>';
				};
				for ($x=1; $x<=ceil($numPagePag); $x++){

					if ( $x == $page ){
						echo '<li class="page-item active"><a class="page-link" href="allApp.php?page='.$x.'">'.$x.'</a></li>';
					}else {
						echo '<li class="page-item"><a class="page-link" href="allApp.php?page='.$x.'">'.$x.'</a></li>';
					}
					
				};
				if ( $page != ceil($numPagePag) ) {
					echo '<li class="page-item"><a class="page-link" href="allApp.php?page='.$next.'">Следующая</a></li>';
				};
			};

		?>
	</ul>
</nav>

<?php
//query to the database with a shift and the number of records
$answers = R::getAll('SELECT * FROM `answers` LIMIT '.$limit.' OFFSET '.$offset);
//output using a loop
foreach ($answers as $answer)
		{?>	
			<div class="col mx-auto">
			 <div class="col px-md-5 media shadow-lg p-3 mb-5 bg-white rounded">
			  <div class="media-body">
				<h5 class="mt-0">Заявка номер - <?php echo $answer['id'] ?></h5>
				<p class="text-muted">
				  <?php 
				  //Output full name
						echo $answer['first_name'].' '.$answer['middle_name'].' '.$answer['_surname'] ?>
					?>
				</p>
				<h5>Сообщение:</h5>
				<p class="text-muted">
				  <?php 
				  //Output message
						echo $answer['message'];
					?>
				</p>
				<h5>Желаемая дата показа:</h5>
				<p class="text-muted">
				  <?php 
				  //Output datetime
						echo $answer['datetime'];
					?>
				</p>
				<h5>Контактные данные:</h5>
				<p class="text-muted">
				  <?php 
				  //Output email and phone
						echo 'Почта -'.$answer['email'].'<br>';
						echo 'Телефон -'.$answer['phone'];
					?>
				</p>
			  </div>
			 </div>
			</div>
		<?php
		};
?> 

	<?php else : ?>
		<!-- сhecking for authorization -->
		<a href="login.php" class="btn btn-primary mt-3 btn-lg active" role="button" aria-pressed="true">Войти</a>
		<small id="hint" class="mb-2 form-text text-muted">*Для администратора</small>
	<?php endif; ?>
</body>
</html>