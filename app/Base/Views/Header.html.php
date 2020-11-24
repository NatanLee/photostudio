<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	
	<link href="css/normalize.css" rel="stylesheet">
	<link rel="stylesheet" href="./src/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link href="css/style.css" rel="stylesheet">	
	<title><?=$title?></title>
</head>
<body>
	<header>
		<div class = "firstLine">
			<div class = "firstLine__contacts">
				<p>
					г. Щучье, ул. Заводская
				</p>
				<p>
					<i class="fa fa-mobile" aria-hidden="true"></i>
					<i class="fa fa-whatsapp" aria-hidden="true"></i>
					

					8(921)123-12-12
				</p>
			</div>
			<div class = "firstLine__logo">
				<div>фото</div>
				<div>студия</div>
			</div>
			<div class = "firstLine__networks">
				<button><a class="instagram" href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></button>
				<button><a class="vk" href="#"><i class="fa fa-vk" aria-hidden="true"></i></a></button>
				<button><a class="telegram" href="#"><i class="fa fa-telegram" aria-hidden="true"></i></a></button>
				<button><a class="ok" href="#"><i class="fa fa-odnoklassniki" aria-hidden="true"></i></a></button>				
			</div>
		</div>
		<div class = "menu">
			<ul>
				<li><a href = "index.php">Главная</a></li>
				<li class = "toggleMenu toggledMenu1"><a href="#">Аренда</a>
					<ul class = "hidden" id = "toggledMenu1">						
						<li><a href = "index.php?price">Стоимость</a></li>
						<li><a href = "/allrooms">Залы</a></li>
						<li><a href = "#">Оборудование</a></li>
						<li><a href = "#">Правила</a></li>
						<li><a href = "#">Акции</a></li>
					</ul>
				</li>
				<li><a href="#">Фотосессия</a></li>
				<li><a href="#">Контакты</a></li>
				<li><a href="#">Партнеры</a></li>
			</ul>	
		</div>
	</header>
