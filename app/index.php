<?php
session_start();

/**
 * Sitemap (можно перенести в отдельный файл)
 */
$GLOBALS['sitemap'] = array (
    '_404' => 'page404.php',   // Страница 404</span>
    '/' => 'mainpage.php',   // Главная страница
    '/news' => 'newspage.php',   // Новости - страница без параметров
    '/stories(/[0-9]+)?' => 'storypage.php',  // С числовым параметром
    // Больше правил
);
 
// Код роутера
class uSitemap {
    public $title = '';
    public $params = null;
    public $classname = '';
    public $data = null;
 
    public $request_uri = '';
    public $url_info = array();
 
    public $found = false;
 
    function __construct() {
        $this->mapClassName();
    }
 
    function mapClassName() {
 
        $this->classname = '';
        $this->title = '';
        $this->params = null;
 
        $map = &$GLOBALS['sitemap'];
        $this->request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $this->url_info = parse_url($this->request_uri);
        $uri = urldecode($this->url_info['path']);
        $data = false;
        foreach ($map as $term => $dd) {
            $match = array();
            $i = preg_match('@^'.$term.'$@Uu', $uri, $match);
            if ($i > 0) {
                // Get class name and main title part
                $m = explode(',', $dd);
                $data = array(
                    'classname' => isset($m[0])?strtolower(trim($m[0])):'',
                    'title' => isset($m[1])?trim($m[1]):'',
                    'params' => $match,
                );
                break;
            }
        }
        if ($data === false) {
            // 404
            if (isset($map['_404'])) {
                // Default 404 page
                $dd = $map['_404'];
                $m = explode(',', $dd);
                $this->classname = strtolower(trim($m[0]));
                $this->title = trim($m[1]);
                $this->params = array();
            }
            $this->found = false;
        } else {
            // Found!
            $this->classname = $data['classname'];
            $this->title = $data['title'];
            $this->params = $data['params'];
            $this->found = true;
        }
        return $this->classname;
    }
}
$sm = new uSitemap();
$routed_file = $sm->classname; // Получаем имя файла для подключения через require()
require('app/'.$routed_file); // Подключаем файл
 
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
