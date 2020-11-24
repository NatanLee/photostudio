<?php
session_start();
spl_autoload_register(function ($className){
	include_once str_replace("\\", "/", $className).'.php';				
});
// Код роутера
use Base\Controllers\BaseController;
class uSitemap extends BaseController{
    public $query;    
    public $path; 
    public $request_uri;
   
    function __construct() {
		parent::__construct();
        $this->mapClassName();
    }
 
    function mapClassName() {
        $this->request_uri = parse_url($_SERVER['REQUEST_URI']);
		$this->path = $this->request_uri['path'];
		$this->query = $this->request_uri['query'];
		$load = $this->getRoute()[$this->path]['controller'];
		$load->{$this->getRoute()[$this->path]['action']}();	
		var_dump($this->getRoute()[$this->path]['action']);
		
	function getRoute(){
		return[
			'/'=>[
				'controller'=>new MainPage\Controllers\MainPageController(),
				'action'=>'getPage',
				'method'=>'get'
			],
			'/price'=>[
				'controller'=>'PriceController',
				'action'=>'getPage',
				'method'=>'get'
			]
			
		];
	}
}
$sm = new uSitemap();

 
// P.S. Внутри подключённого файла Вы можете использовать параметры запроса,
// которые хранятся в свойстве $sm->params







/* 
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



 */
