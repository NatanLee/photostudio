<?php
namespace oop\Rooms\Controllers;

use oop\Base\Controllers\BaseController;
use oop\Rooms\Models\RoomsModel;

class RoomsController extends BaseController
{	
	public $errors;
		
	
		
	public function __construct()
	{
		parent::__construct();
		
		$this->errors = [];
		
		
				
	}
//получить список всех
	public function getRooms(){
		$mRoomsModel = new RoomsModel();
		$rooms = $mRoomsModel->getRoomsInfo();
		echo $this->fullRender('oop/Rooms/Views/Rooms.html.php',[
			'title'=>'Выбор зала для фотосессии',
			'rooms'=>$rooms
		]);	
	}
	
	public function getOneRoom(){		
		$mRoomsModel = new RoomsModel();
		$room = $mRoomsModel->getRoomImages($this->get['room_details']);
//var_dump($room);
		echo $this->fullRender('oop/Rooms/Views/Room.html.php',[
			'title'=>'Зал для фотосессии "'.$room['roomName'].'"',
			'room'=>$room
		]);	
	}


}