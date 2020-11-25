<?php
namespace oop\Base\Controllers;

abstract class BaseController
{
	protected $get;
	protected $post;
	protected $session;
	protected $server;

	protected function __construct()
	{
		$this->get = $_GET;
		$this->post = $_POST;
		$this->session = $_SESSION;
	}
	
	//функции не используется	
	/* public function render($filename, $values = array())
	{
		ob_start();
		extract($values);
		include($filename);
		return ob_get_clean();
	}
	
	public function pageTop()
	{
		return $this->render('Base/Views/header.html.php', []);
	}
	
	public function pageBottom()
	{		
		return $this->render('Base/Views/footer.html.php', []);
	} */
	
	public function fullRender($filename, $values = array())
	{
		ob_start();
		extract($values);		
		//echo $this->pageTop();
		include('oop/Base/Views/header.html.php');
		include($filename);
		//echo $this->pageBottom();
		include('oop/Base/Views/footer.html.php');
		return ob_get_clean();
	}
	
	protected function getRedirect($url){
		header("Location: $url");
		die;
	}
	
	public function get404(){
		
	}

}