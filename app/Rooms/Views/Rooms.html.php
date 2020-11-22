<section class = "rooms">
	<h2>Аренда фотостудии<span>Выбор зала</span></h2>
	<div class = "roomlist">
		<?foreach($rooms as $room):?>
		<div class = "roomlist__room">
			<div class = "roomlist__image">
				<img src="./src/rooms/<?=$room['folderName']?>/<?=$room['fileName']?>">
			</div>
			<div class = "roomlist__cover">
				<p><?=$room['roomName']?><p>
				<a href = "index.php?room_details=<?=$room['folderName']?>">Подробнее</a>
			</div>
		</div>
		<?endforeach;?>
	</div>
	
</section>

