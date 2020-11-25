<?php
namespace oop\MainPage\Models;

class MainPageModel
{
	public $errors;
		
	public function __construct()
	{
		$this->errors = [];				
	}

//получить список пaпок и файлов в них  массивом	
	public function getFolders(){
		$folders = array_slice(scandir('src/rooms'),2);
		//$imgFolders;
		foreach ($folders as $i => $folder) {
			$files = array_slice(scandir('src/rooms/'.$folder),2);
			$sliderTitle = "Отсутствует файл roomName.txt";	
				foreach ($files as $j => $file) {
					if (fnmatch("roomName.txt", $file)) {
						$sliderTitle = file_get_contents("./src/rooms/".$folder."/".$file);
					}
					if (fnmatch("*.txt", $file)) {
						unset($files[$j]);
					}
				}			
			$folders[$i] = [
				'folderName'=>$folder,
				'folderFiles'=>$files,
				'sliderTitle'=>$sliderTitle
			];				
		}
		return $folders;
	}
}




?>