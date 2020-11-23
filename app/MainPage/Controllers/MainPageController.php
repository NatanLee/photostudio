<?php
namespace MainPage\Controllers;

use Base\Controllers\BaseController;
use MainPage\Models\MainPageModel;

class MainPageController extends BaseController
{	
	public $errors;
		
	
		
	public function __construct()
	{
		parent::__construct();
		
		$this->errors = [];
		
		
				
	}
//получить список всех
	public function getPage()
	{
		$MainPageModel = new MainPageModel();
		$imgFolders = $MainPageModel->getFolders();
//echo '<pre>';var_dump($imgFolders);		
		echo $this->fullRender('MainPage/Views/MainPage.html.php',[
			'title'=>'Фотостудия "Название". Аренда фотостудии в Щучье',
			'imgFolders'=>$imgFolders		
		]);	
	}














	public function setCalibration()
	{
		$dt = htmlspecialchars(trim($this->post['dt']));
		$method_int_code = htmlspecialchars(trim($this->post['method_int_code']));
		$method_ext_code = htmlspecialchars(trim($this->post['method_ext_code']));
		$element = htmlspecialchars(trim($this->post['element']));
		$concentration_unit = htmlspecialchars(trim($this->post['concentration_unit']));
		$executor = htmlspecialchars(trim($this->post['executor']));
		$details = substr(nl2br(htmlspecialchars(addslashes(trim($this->post['details'])))) ,0,3000);
		$dt_next = htmlspecialchars(trim($this->post['dt_next']));
		
		
		$db = DBModel::Instance();
		$db->sqlQuery("INSERT INTO vkk_calibration SET
			dt = '$dt',
			method_int_code = '$method_int_code',
			method_ext_code = '$method_ext_code',
			element = '$element',
			concentration_unit = '$concentration_unit',
			executor = '$executor',
			details = '$details',
			dt_next = '$dt_next'");
		header('Location: index.php?calibration');
		exit;
	}
	
//внести точку калибровки
	public function setCalibrationPoint()
	{
		$dt = htmlspecialchars(trim($this->post['dt']));
		$calibration_index = htmlspecialchars(trim($this->post['calibration_index']));
		$concentration = htmlspecialchars(trim($this->post['concentration']));
		$amount = htmlspecialchars(trim($this->post['amount']));
		$add_info = htmlspecialchars(trim($this->post['add_info']));

//echo "<pre>";
//var_dump ($GLOBALS);exit;		
		
		$db = DBModel::Instance();
		$db->sqlQuery("INSERT INTO vkk_calibration_measurings SET
			dt = '$dt',
			calibration_index = '$calibration_index',
			concentration = '$concentration',
			amount = '$amount',
			add_info = '$add_info'");
		header('Location: index.php?calibrationsDetails='.$calibration_index);
		exit();
		//$this->getAll();
	}	
	
	
	public function getDetails()
	{
		$db = DBModel::Instance();
		$all = $db->sqlQuery("SELECT * FROM vkk_calibration WHERE ind = '".$this->get['calibrationsDetails']."'")->fetchOneResult();
		$all['measurings'] = $db->sqlQuery("SELECT * FROM vkk_calibration_measurings WHERE calibration_index = '".$this->get['calibrationsDetails']."'")->fetchAllResult();
		
//echo "<pre>";
//var_dump($all); exit;//del
		echo $this->fullRender('Calibration/Views/CalibrationDetails.html.php',[
			'errors'=>$this->errors, 
			'all'=>$all,						
		]);	
	}
	
//внести запись	
	public function setOne()
		{			
			$this->dt = htmlspecialchars(trim($_POST['dt']));
			$this->customer_type = htmlspecialchars(trim($_POST['customer_type']));
			$this->request_form = htmlspecialchars(trim($_POST['request_form']));
			$this->lab_contact_person = htmlspecialchars(trim($_POST['lab_contact_person']));
			$this->org = htmlspecialchars(trim($_POST['org']));
			$this->contact_person = htmlspecialchars(trim($_POST['contact_person']));
			$this->address = htmlspecialchars(trim($_POST['address']));
			$this->tel = htmlspecialchars(trim($_POST['tel']));			
			$this->e_mail = htmlspecialchars(trim($_POST['e_mail']));
			$this->purpose = htmlspecialchars(trim($_POST['purpose']));
			$this->result = htmlspecialchars(trim($_POST['result']));
			$this->price = htmlspecialchars(trim($_POST['price']));			
			$this->contract_number = htmlspecialchars(trim($_POST['contract_number']));
								
			if (empty($this->errors)){
				$db = DBModel::Instance();
				$db->sqlQuery("INSERT requests SET 
				dt = '$this->dt', 
				customer_type = '$this->customer_type', 
				request_form = '$this->request_form', 
				lab_contact_person = '$this->lab_contact_person', 
				org = '$this->org', 
				contact_person = '$this->contact_person', 
				address = '$this->address', 
				tel = '$this->tel',
				e_mail = '$this->e_mail',
				purpose = '$this->purpose',				
				result = '$this->result',				
				price = '$this->price',				
				contract_number = '$this->contract_number'				
				");
				header('Location: index.php?requests');
				exit();
			}else{
				$this->getAll();
			}
		}		
}