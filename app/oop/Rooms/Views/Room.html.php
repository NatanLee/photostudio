<section class = "one-room">
	<h2><?=$room['roomName']?></h2>
	<h3 class = "one-room__gallery">Фотогалерея</h3>
	<div class = "one-room__images">
	<?foreach($room['roomImages'] as $image):?>
		<img class = "one-room__one-image" src="/src/rooms/<?=$room['folderName']?>/<?=$image?>">
	<?endforeach;?>	
	</div>
	<button class = "one-room__button">Показать все фотографии</button>
	<article class = "one-room__description">
		<h3>Описание</h3>
		<div>
		</div>
	</article>
	<div class = "one-room__popup">
		<div><img src=""></div>
	</div>	
</section>


