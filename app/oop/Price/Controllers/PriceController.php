<?php
namespace oop\Price\Controllers;

use oop\Base\Controllers\BaseController;
use oop\Price\Models\PriceModel;

class PriceController extends BaseController
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
		$mPriceList = new PriceModel();
		$priceList = $mPriceList->getPrices();
		echo $this->fullRender('oop/Price/Views/Price.html.php',[
			'title'=>'Прайс-лист фотостудии',
			'priceList'=>$priceList
		]);	
	}

	
}