<?php
namespace Price\Controllers;

use Base\Controllers\BaseController;
use Price\Models\PriceModel;

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
		echo $this->fullRender('Price/Views/Price.html.php',[
			'title'=>'Прайс-лист фотостудии',
			'priceList'=>$priceList
		]);	
	}

	
}