<?php
namespace oop\Price\Models;

class PriceModel
{
	
	public function getPrices(){
		$folders = array_slice(scandir('src/rooms'),2);
		$prices;
		//$imgFolders;
		foreach ($folders as $i => $folder) {
			$prices[$i] = [
				"roomName"=>"Отсутствует файл roomName.txt",
				"firstPrice"=>"Нет данных",
				"secondPrice"=>"Нет данных"];
			$files = array_slice(scandir('src/rooms/'.$folder),2);		
			
			foreach ($files as $j => $file) {				
				if (fnmatch("roomName.txt", $file)){
					$prices[$i]['roomName'] = file_get_contents("src/rooms/".$folder."/".$file);						
				}
				if (fnmatch("roomPrice.txt", $file)){
					$roomPrice = explode(' ', file_get_contents("src/rooms/".$folder."/".$file));
					$prices[$i]['firstPrice'] = $roomPrice[0];
					$prices[$i]['secondPrice'] = $roomPrice[1];						
				}
			}									
		}	
		return $prices;
	}
}




?>