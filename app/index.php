<?php
session_start();

spl_autoload_register(function ($className){
	include_once str_replace("\\", "/", $className).'.php';	
});
		
//распоряжения
	if (isset($_GET['price'])){
		$rec = new Price\Controllers\PriceController();
		$rec->getPage();		
	}elseif (isset($_GET['rooms'])){
		$rec = new Rooms\Controllers\RoomsController();
		$rec->getRooms();	
	}elseif (isset($_GET['room_details'])){
		$rec = new Rooms\Controllers\RoomsController();
		$rec->getOneRoom();	
		
	
	}else{
		$main = new MainPage\Controllers\MainPageController();
		$main->getPage();
	}




