<?php
session_start();
spl_autoload_register(function ($className){
	include_once str_replace("\\", "/", $className).'.php';				
});
// Код роутера
use Base\Controllers\BaseController;
class uSitemap extends BaseController{
    public $path;
    public $params;
    public $classname; 
    public $request_uri;
   
    function __construct() {
        $this->mapClassName();
    }
 
    function mapClassName() {
 
        $this->classname = '';
        $this->path = '';
        $this->params;
 
       
        $this->request_uri = parse_url($_SERVER['REQUEST_URI']);
				$this->path = explode('/', $this->request_uri['path']);
				$this->get = $this->request_uri['query'];
       
var_dump($this->get);
       

      	$this->loadPage();		
			
    }
		
		function loadPage(){
			var_dump('hello');
			
	
			$load = new MainPage\Controllers\MainPageController();
			$load->getPage();	
		}
		
		function getRoute(){
			return[
				'/'=>[
					'controller'=>'MainPageController',
					'action'=>'getPage',
					'method'=>'GET'
				]
				'/price'=>[
					'controller'=>'PriceController',
					'action'=>'getPage',
					'method'=>'GET'
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
