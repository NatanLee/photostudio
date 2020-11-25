<main class = "main">
	<div id = "bigSlider">
		<div id="bigSlider__buttons">
			<button class="controls" id="bigSliderPrevious"><i class="fa fa-4x fa-step-backward" aria-hidden="true"></i>
</button>
			<button class="controls" id="bigSliderPause"><i class="fa fa-pause fa-4x" aria-hidden="true"></i></button>
			<button class="controls" id="bigSliderNext"><i class="fa fa-4x fa-step-forward" aria-hidden="true"></i></button>	
		</div>
		<div class = "bigSlider__dots">
			
		</div>
	</div>



<div class="main__title">
	<h1>
		<span>Фотостудия в Щучье</span>
		<span>аренда съёмочных залов и проведение всех видов фотосессий</span>
	<h1>
</div>
<div class="rooms">
	<h2>Съемочные залы</h2>
	<?foreach($imgFolders as $folder):?>
	<div class = "rooms__room room<?=$folder['folderName']?>">
		<h3><?=$folder['sliderTitle']?></h3>
		<div class="rooms__slider">
			<ul class="slimSlider__list">
			<?foreach($folder['folderFiles'] as $sliderImg):?>	
				<li class="slimSlider__element"><img src=<?="/src/rooms/".$folder['folderName']."/".$sliderImg?>></li>
			<?endforeach;?>	
			</ul>
			<div class="rooms__buttons">
				<button class="btn arrowLeft"><i class="fa fa-4x fa-step-backward" aria-hidden="true"></i></button>
				<button class="btn arrowRight"><i class="fa fa-4x fa-step-forward" aria-hidden="true"></i></button>
			</div>		
		</div>
		
	</div>
	<?endforeach;?>








	
	<!-- </div>
	<div id = "rooms__room room_2"> -->
		
	
</div>
</main>



