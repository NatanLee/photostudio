<?php
namespace Rooms\Models;

class RoomsModel
{
//получить случайную картинку из папки, имя папки и название комнаты из файла	
	public function getRoomsInfo(){
		$folders = array_slice(scandir('src/rooms'),2);
		foreach ($folders as $i => $folder) {
			$files = array_slice(scandir('src/rooms/'.$folder),2);
			$roomName = "Отсутствует файл roomName.txt";	
				foreach ($files as $j => $file) {
					if (fnmatch("roomName.txt", $file)) {
						$roomName = file_get_contents("./src/rooms/".$folder."/".$file);					
					}
					if (fnmatch("*.txt", $file)) {
						unset($files[$j]);					
					}
				}
			$ind = array_rand($files);	
			$folders[$i] = [
				'folderName'=>$folder,
				'fileName'=>$files[$ind],
				'roomName'=>$roomName
			];				
		}
		return $folders;
	}
//получить файлов из папки		
	public function getRoomImages($folderName){
		$files = array_slice(scandir('src/rooms/'.$folderName),2);			
		$roomName = "Отсутствует файл roomName.txt";
		$filesArray = [];
		$counter = 0;
		foreach ($files as $j => $file) {
			if (fnmatch("roomName.txt", $file)) {
				$roomName = file_get_contents("./src/rooms/".$folderName."/".$file);
			}
			if (fnmatch("*.txt", $file)) {
				unset($files[$j]);
			}
		}
		
		$filesArray = array_chunk($files, ceil(count($files)/3));
				
		$result = [
			'folderName'=>$folderName,
			'roomImages'=>$files,
			'roomName'=>$roomName
		];				
//echo '<pre>';var_dump($filesArray);		
		return $result;
	}
}




?>