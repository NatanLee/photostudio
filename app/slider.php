<?
if (isset($_GET['bigSlider'])){
	echo json_encode(array_slice(scandir('./src/bigSlider'), 2));
}
if (isset($_GET['slimSlider'])){
	$room = $_GET['slimSlider'];
	echo json_encode(array_slice(scandir('./src/rooms/'.$room), 2));
}
?>